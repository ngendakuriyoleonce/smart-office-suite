<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
            'settings.edit',
            'reports.view', 'reports.export',
            'employees.view', 'employees.create', 'employees.edit', 'employees.delete',
            'departments.view', 'departments.create', 'departments.edit', 'departments.delete',
            'positions.view', 'positions.create', 'positions.edit', 'positions.delete',
            'hr-documents.view', 'hr-documents.create', 'hr-documents.edit', 'hr-documents.delete',
            'visitors.check-in', 'visitors.view', 'visitors.edit',
            'meeting-rooms.book', 'meeting-rooms.view', 'meeting-rooms.create', 'meeting-rooms.edit', 'meeting-rooms.delete',
            'front-desk.manage',
            'assets.view', 'assets.create', 'assets.edit', 'assets.delete',
            'logistics.view', 'logistics.manage',
            'facilities.view', 'facilities.manage',
            'profile.view', 'profile.edit',
            'notifications.view', 'notifications.mark-read',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $superAdmin = Role::findOrCreate('Super Admin');
        $ceo = Role::findOrCreate('CEO');
        $hrManager = Role::findOrCreate('HR Manager');
        $receptionist = Role::findOrCreate('Receptionist');
        $officeManager = Role::findOrCreate('Office Manager');
        $employee = Role::findOrCreate('Employee');

        $superAdmin->givePermissionTo(Permission::all());

        $ceo->givePermissionTo([
            'reports.view',
            'reports.export',
            'employees.view',
            'departments.view',
            'positions.view',
        ]);

        $hrManager->givePermissionTo([
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',
            'departments.view',
            'departments.create',
            'departments.edit',
            'departments.delete',
            'positions.view',
            'positions.create',
            'positions.edit',
            'positions.delete',
            'hr-documents.view',
            'hr-documents.create',
            'hr-documents.edit',
            'hr-documents.delete',
            'reports.view',
            'profile.view',
            'profile.edit',
            'notifications.view',
            'notifications.mark-read',
        ]);

        $receptionist->givePermissionTo([
            'visitors.check-in',
            'visitors.view',
            'visitors.edit',
            'meeting-rooms.book',
            'meeting-rooms.view',
            'meeting-rooms.create',
            'meeting-rooms.edit',
            'meeting-rooms.delete',
            'front-desk.manage',
            'profile.view',
            'profile.edit',
            'notifications.view',
            'notifications.mark-read',
        ]);

        $officeManager->givePermissionTo([
            'assets.view',
            'assets.create',
            'assets.edit',
            'assets.delete',
            'logistics.view',
            'logistics.manage',
            'facilities.view',
            'facilities.manage',
            'meeting-rooms.view',
            'meeting-rooms.book',
            'profile.view',
            'profile.edit',
            'notifications.view',
            'notifications.mark-read',
        ]);

        $employee->givePermissionTo([
            'profile.view',
            'profile.edit',
            'notifications.view',
            'notifications.mark-read',
        ]);
    }
}
