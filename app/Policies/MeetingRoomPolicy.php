<?php

namespace App\Policies;

use App\Models\MeetingRoom;
use App\Models\User;

class MeetingRoomPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('meeting-rooms.view');
    }

    public function view(User $user, MeetingRoom $meetingRoom): bool
    {
        return $user->can('meeting-rooms.view');
    }

    public function create(User $user): bool
    {
        return $user->can('meeting-rooms.create');
    }

    public function update(User $user, MeetingRoom $meetingRoom): bool
    {
        return $user->can('meeting-rooms.edit');
    }

    public function delete(User $user, MeetingRoom $meetingRoom): bool
    {
        return $user->can('meeting-rooms.delete');
    }

    public function restore(User $user, MeetingRoom $meetingRoom): bool
    {
        return $user->can('meeting-rooms.delete');
    }

    public function forceDelete(User $user, MeetingRoom $meetingRoom): bool
    {
        return $user->can('meeting-rooms.delete');
    }

    public function book(User $user, MeetingRoom $meetingRoom): bool
    {
        return $user->can('meeting-rooms.book');
    }
}
