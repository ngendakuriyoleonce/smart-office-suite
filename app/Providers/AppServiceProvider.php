<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\PositionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Department::class, DepartmentPolicy::class);
        Gate::policy(Employee::class, EmployeePolicy::class);
        Gate::policy(Position::class, PositionPolicy::class);
    }
}
