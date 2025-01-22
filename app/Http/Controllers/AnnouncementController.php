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

    
}
