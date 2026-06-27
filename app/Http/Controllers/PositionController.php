<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index(): View
    {
        $positions = Position::with('department')->latest()->paginate(10);
        return view('positions.index', compact('positions'));
    }

    public function create(): View
    {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    public function store(StorePositionRequest $request): RedirectResponse
    {
        Position::create($request->validated());
        return to_route('positions.index')->with('success', 'Position created successfully.');
    }

    public function show(Position $position): View
    {
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position): View
    {
        $departments = Department::all();
        return view('positions.edit', compact('position', 'departments'));
    }

    public function update(UpdatePositionRequest $request, Position $position): RedirectResponse
    {
        $position->update($request->validated());
        return to_route('positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();
        return to_route('positions.index')->with('success', 'Position deleted successfully.');
    }
}
