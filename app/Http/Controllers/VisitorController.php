<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Models\Employee;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VisitorController extends Controller
{
    public function index(): View
    {
        $visitors = Visitor::with('host')->latest()->paginate(10);
        return view('visitors.index', compact('visitors'));
    }

    public function create(): View
    {
        $employees = Employee::all();
        return view('visitors.create', compact('employees'));
    }

    public function store(StoreVisitorRequest $request): RedirectResponse
    {
        Visitor::create($request->validated());
        return to_route('visitors.index')->with('success', 'Visitor created successfully.');
    }

    public function show(Visitor $visitor): View
    {
        $visitor->load('host');
        return view('visitors.show', compact('visitor'));
    }

    public function edit(Visitor $visitor): View
    {
        $employees = Employee::all();
        return view('visitors.edit', compact('visitor', 'employees'));
    }

    public function update(UpdateVisitorRequest $request, Visitor $visitor): RedirectResponse
    {
        $visitor->update($request->validated());
        return to_route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    public function destroy(Visitor $visitor): RedirectResponse
    {
        $visitor->delete();
        return to_route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }
}
