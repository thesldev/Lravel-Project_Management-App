<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(){
        // fetch client data from model
        $clients = Employees::all();
        return view('employees.index');

    }

    // function for load add project page
    public function create(){
        return view('employees.create');
    }

    // function for store employee data
    public function store(Request $request){

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:0,1,2',
            'job_role' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'join_date' => 'required|date',
            'password' => 'required|min:8',
        ]);

        $validate['password'] = bcrypt($validate['password']);

        Employees::create($validate);

        // Redirect to the index page
        return redirect()->route('employee.index')->with('success', 'Employee created successfully!');

    }
}
