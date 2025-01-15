<?php

namespace App\Http\Controllers;

use App\Models\Servics;
use Illuminate\Http\Request;

class ServiceContoller extends Controller
{
    //

    public function index(){
        $services = Servics::all();

        return view('services.index', compact('services'));
    }


}
