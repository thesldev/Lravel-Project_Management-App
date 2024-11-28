<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    //

    public function index(){
        return view('boards.index');
    }
}
