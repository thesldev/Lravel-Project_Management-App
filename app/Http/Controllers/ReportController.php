<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Report;
use App\Models\Sprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReportController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'columns' => 'required|array',
        ]);

        // Store the report data
        $report = Report::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'created_by' => \Illuminate\Support\Facades\Auth::id(), 
        ]);

        // Redirect to the generate PDF route with the report data and selected columns
        return redirect()->route('generate.report', [
            'reportId' => $report->id,
            'columns' => $request->input('columns')
        ]);
    }

    public function generateReport(Request $request)
    {
        // Validate and get the selected columns
        $columns = $request->input('columns', []);

        // Get project data with the selected columns
        $projects = Project::select($columns)->get();

        // Retrieve the report using the report ID from the request
        $report = Report::findOrFail($request->input('reportId'));

        // Pass data to the view and render HTML content
        $html = view('pdf.project_pdf_template', compact('columns', 'projects', 'report'))->render();

        // Generate the PDF
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        // Return the PDF as a stream for direct download
        return $pdf->stream('project_report.pdf');
    }



    public function generateSprintReport(Request $request)
    {
        // Fetch sprints data
        $sprints = Sprint::all();

        // Generate the HTML view for the report
        $html = view('pdf.sprint_report', compact('sprints'))->render();

        // Generate the PDF using Dompdf
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        // Download the PDF
        return $pdf->download('sprints_report.pdf');
    }



}
