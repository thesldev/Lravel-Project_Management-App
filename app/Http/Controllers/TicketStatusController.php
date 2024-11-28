<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    //

    public function index(){
        return view('tickets.status');
    }
}
