<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Servics;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //
    public function newAnnouncement(){
        $services = Servics::all();
        return view('announcements.create', compact('services'));
    }

    // function for view all announcements from admin side,
    public function index(){
        $announcements = Announcement::all();
        return view('announcements.index', compact('announcements'));
    }

    // function for store announcement
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'service' => 'required|string|max:255',
        ]);
    
        Announcement::create([
            'created_by' => $request->created_by,
            'creator_email' => $request->creator_email,
            'title' => $request->title,
            'body' => $request->body,
            'priority' => $request->priority,
            'service' => $request->service,
        ]);
    
        return redirect()->back()->with('success', 'Announcement created successfully!');
    }


    // function for view selected announcement
    public function viewAnnouncement($id){
        $announcements = Announcement::with('creator')->findOrFail($id);

        return view('announcements.view', compact('announcements'));
    }

    // function for update selected announcement
    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'priority' => 'required|string',
        ]);

        $announcement->update([
            'title' => $request->title,
            'body' => $request->body,
            'priority' => $request->priority,
        ]);

        return redirect()->route('announcements.view', $id)->with('success', 'Announcement updated successfully.');
    }


    // AnnouncementController.php
    public function deleteData($id)
    {
        $announcement = Announcement::findOrFail($id);

        // Check if the announcement exists
        if ($announcement) {
            $announcement->delete();
            return redirect()->route('announcement.index')->with('success', 'Announcement deleted successfully.');
        }

        return redirect()->route('announcement.index')->with('error', 'Announcement not found.');
    }


}
