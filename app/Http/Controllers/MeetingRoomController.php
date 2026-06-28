<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRoomRequest;
use App\Http\Requests\UpdateMeetingRoomRequest;
use App\Models\MeetingRoom;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MeetingRoomController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', MeetingRoom::class);
        $meetingRooms = MeetingRoom::latest()->paginate(10);
        return view('meeting-rooms.index', compact('meetingRooms'));
    }

    public function create(): View
    {
        $this->authorize('create', MeetingRoom::class);
        return view('meeting-rooms.create');
    }

    public function store(StoreMeetingRoomRequest $request): RedirectResponse
    {
        $this->authorize('create', MeetingRoom::class);
        MeetingRoom::create($this->prepareData($request));
        return to_route('meeting-rooms.index')->with('success', 'Meeting room created successfully.');
    }

    public function show(MeetingRoom $meetingRoom): View
    {
        $this->authorize('view', $meetingRoom);
        return view('meeting-rooms.show', compact('meetingRoom'));
    }

    public function edit(MeetingRoom $meetingRoom): View
    {
        $this->authorize('update', $meetingRoom);
        return view('meeting-rooms.edit', compact('meetingRoom'));
    }

    public function update(UpdateMeetingRoomRequest $request, MeetingRoom $meetingRoom): RedirectResponse
    {
        $this->authorize('update', $meetingRoom);
        $meetingRoom->update($this->prepareData($request));
        return to_route('meeting-rooms.index')->with('success', 'Meeting room updated successfully.');
    }

    public function destroy(MeetingRoom $meetingRoom): RedirectResponse
    {
        $this->authorize('delete', $meetingRoom);
        $meetingRoom->delete();
        return to_route('meeting-rooms.index')->with('success', 'Meeting room deleted successfully.');
    }

    private function prepareData($request): array
    {
        $data = $request->validated();

        if ($request->has('amenities') && is_string($request->input('amenities'))) {
            $data['amenities'] = array_filter(
                array_map('trim', explode("\n", $request->input('amenities'))),
                fn($v) => $v !== ''
            );
        }

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
