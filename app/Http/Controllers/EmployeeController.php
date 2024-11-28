<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(){
        // fetch employee data from model
        $employees = Employees::all();

        return view('employees.index', ['employees' => $employees]);

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

    // function for get selected employee data
    public function viewEmployee(Employees $employee){
        return view('employees.view', compact('employee'));
    }


    // function for update existing employee
    public function update(Employees $employee, Request $request)
    {
        $data = $request->validate([
            'role' => 'required|in:0,1,2',
            'job_role' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $employee->update($data);
        
    }

    // function for delete employees
    public function destroy(Employees $employee)
    {
        // Delete the project
        $employee->delete();

        // Return the index view with the updated projects list
        return redirect()->route('employee.index')->with('success', 'Employee Deleted successfully');

    }


    // get employee for tickets
    public function getEmployees()
    {
        $employees = Employees::select('id', 'name')->get();
        return response()->json($employees);
    }


}
