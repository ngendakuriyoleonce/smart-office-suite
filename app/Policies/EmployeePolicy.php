<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('employee-list');
    }

    public function view(User $user, Employee $employee): bool
    {
        return $user->can('employee-list');
    }

    public function create(User $user): bool
    {
        return  true;
    }

    public function update(User $user, Employee $employee): bool
    {
        return $user->can('employee-edit');
    }

    public function delete(User $user, Employee $employee): bool
    {
        return $user->can('employee-delete');
    }

    public function restore(User $user, Employee $employee): bool
    {
        return $user->can('employee-delete');
    }

    public function forceDelete(User $user, Employee $employee): bool
    {
        return $user->can('employee-delete');
    }
}
