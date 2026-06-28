<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visitor;

class VisitorPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('visitors.view');
    }

    public function view(User $user, Visitor $visitor): bool
    {
        return $user->can('visitors.view');
    }

    public function create(User $user): bool
    {
        return $user->can('visitors.edit');
    }

    public function update(User $user, Visitor $visitor): bool
    {
        return $user->can('visitors.edit');
    }

    public function delete(User $user, Visitor $visitor): bool
    {
        return $user->can('visitors.edit');
    }

    public function checkIn(User $user, Visitor $visitor): bool
    {
        return $user->can('visitors.check-in');
    }

    public function checkOut(User $user, Visitor $visitor): bool
    {
        return $user->can('visitors.check-in');
    }
}
