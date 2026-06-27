<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\PositionPolicy;
use App\Services\OpenCodeAIService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('open-code-ai', fn () => new OpenCodeAIService);
    }

    public function boot(): void
    {
        class_alias(\App\Facades\OpenCodeAI::class, 'OpenCodeAI');

        Gate::policy(Department::class, DepartmentPolicy::class);
        Gate::policy(Employee::class, EmployeePolicy::class);
        Gate::policy(Position::class, PositionPolicy::class);
    }
}
