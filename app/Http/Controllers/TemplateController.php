<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    // create function for display home page
    public function index(){
        return view('dashboard');
    }
}
