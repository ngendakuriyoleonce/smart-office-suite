<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Department::class);
        $departments = Department::with('manager')->latest()->paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create(): View
    {
        $this->authorize('create', Department::class);
        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        $this->authorize('create', Department::class);
        Department::create($request->validated());

        return to_route('departments.index')->with('success', 'Department created successfully.');
    }

    public function show(Department $department): View
    {
        $this->authorize('view', $department);
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department): View
    {
        $this->authorize('update', $department);
        return view('departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        $this->authorize('update', $department);
        $department->update($request->validated());

        return to_route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        $this->authorize('delete', $department);
        $department->delete();

        return to_route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
