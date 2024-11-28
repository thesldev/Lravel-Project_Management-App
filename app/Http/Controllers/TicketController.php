<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index(){
        return view('tickets.index');
    }

    // function for store ticket data into db
   
}
