<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees',
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'dob' => 'required|date',
            'doj' => 'required|date',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }


public function edit($id)
{
    $employee = Employee::findOrFail($id);
    return view('employees.create', compact('employee'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email,' . $id,
        'dob' => 'required|date',
        'doj' => 'required|date',
    ]);

    $employee = Employee::findOrFail($id);
    $employee->update($request->all());

    return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
}
public function destroy($id)
{
    $employee = Employee::findOrFail($id);

    $employee->delete();

    return redirect()->route('employees.index')->with('status', 'Employee deleted successfully!');
}

}
