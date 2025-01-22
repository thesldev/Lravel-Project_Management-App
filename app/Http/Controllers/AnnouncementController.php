<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //
    public function newAnnouncement(){
        return view('announcements.create');
    }
}
