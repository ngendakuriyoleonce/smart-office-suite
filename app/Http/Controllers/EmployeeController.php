<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::with('user', 'department', 'position')->latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt(Str::password()),
        ]);

        Employee::create(array_merge($request->validated(), [
            'user_id' => $user->id,
        ]));

        return to_route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee): View
    {
        $employee->load('user', 'department', 'position');
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee): View
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
        ]);

        $employee->update($request->validated());

        return to_route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();
        return to_route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
