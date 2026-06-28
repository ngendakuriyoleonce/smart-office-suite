<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingBookingRequest;
use App\Http\Requests\UpdateMeetingBookingRequest;
use App\Models\MeetingBooking;
use App\Models\MeetingRoom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MeetingBookingController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', MeetingRoom::class);
        $bookings = MeetingBooking::with('room', 'bookedBy')->latest()->paginate(10);
        return view('meeting-bookings.index', compact('bookings'));
    }

    public function create(): View
    {
        $this->authorize('book', MeetingRoom::class);
        $rooms = MeetingRoom::where('is_active', true)->get();
        return view('meeting-bookings.create', compact('rooms'));
    }

    public function store(StoreMeetingBookingRequest $request): RedirectResponse
    {
        $this->authorize('book', MeetingRoom::class);
        MeetingBooking::create([
            ...$request->validated(),
            'booked_by' => Auth::id(),
        ]);
        return to_route('meeting-bookings.index')->with('success', 'Meeting booked successfully.');
    }

    public function show(MeetingBooking $meetingBooking): View
    {
        $this->authorize('view', MeetingRoom::class);
        $meetingBooking->load('room', 'bookedBy');
        return view('meeting-bookings.show', compact('meetingBooking'));
    }

    public function edit(MeetingBooking $meetingBooking): View
    {
        $this->authorize('book', MeetingRoom::class);
        $rooms = MeetingRoom::where('is_active', true)->get();
        return view('meeting-bookings.edit', compact('meetingBooking', 'rooms'));
    }

    public function update(UpdateMeetingBookingRequest $request, MeetingBooking $meetingBooking): RedirectResponse
    {
        $this->authorize('book', MeetingRoom::class);
        $meetingBooking->update($request->validated());
        return to_route('meeting-bookings.index')->with('success', 'Meeting booking updated successfully.');
    }

    public function destroy(MeetingBooking $meetingBooking): RedirectResponse
    {
        $this->authorize('book', MeetingRoom::class);
        $meetingBooking->delete();
        return to_route('meeting-bookings.index')->with('success', 'Meeting booking cancelled successfully.');
    }
}
