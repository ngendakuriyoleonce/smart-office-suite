<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'users.view']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);

        Permission::create(['name' => 'roles.view']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        Permission::create(['name' => 'settings.edit']);

        Permission::create(['name' => 'reports.view']);
        Permission::create(['name' => 'reports.export']);

        Permission::create(['name' => 'employees.view']);
        Permission::create(['name' => 'employees.create']);
        Permission::create(['name' => 'employees.edit']);
        Permission::create(['name' => 'employees.delete']);

        Permission::create(['name' => 'departments.view']);
        Permission::create(['name' => 'departments.create']);
        Permission::create(['name' => 'departments.edit']);
        Permission::create(['name' => 'departments.delete']);

        Permission::create(['name' => 'positions.view']);
        Permission::create(['name' => 'positions.create']);
        Permission::create(['name' => 'positions.edit']);
        Permission::create(['name' => 'positions.delete']);

        Permission::create(['name' => 'hr-documents.view']);
        Permission::create(['name' => 'hr-documents.create']);
        Permission::create(['name' => 'hr-documents.edit']);
        Permission::create(['name' => 'hr-documents.delete']);

        Permission::create(['name' => 'visitors.check-in']);
        Permission::create(['name' => 'visitors.view']);
        Permission::create(['name' => 'visitors.edit']);

        Permission::create(['name' => 'meeting-rooms.book']);
        Permission::create(['name' => 'meeting-rooms.view']);

        Permission::create(['name' => 'front-desk.manage']);

        Permission::create(['name' => 'assets.view']);
        Permission::create(['name' => 'assets.create']);
        Permission::create(['name' => 'assets.edit']);
        Permission::create(['name' => 'assets.delete']);

        Permission::create(['name' => 'logistics.view']);
        Permission::create(['name' => 'logistics.manage']);

        Permission::create(['name' => 'facilities.view']);
        Permission::create(['name' => 'facilities.manage']);

        Permission::create(['name' => 'profile.view']);
        Permission::create(['name' => 'profile.edit']);

        Permission::create(['name' => 'notifications.view']);
        Permission::create(['name' => 'notifications.mark-read']);

        $superAdmin = Role::create(['name' => 'Super Admin']);
        $ceo = Role::create(['name' => 'CEO']);
        $hrManager = Role::create(['name' => 'HR Manager']);
        $receptionist = Role::create(['name' => 'Receptionist']);
        $officeManager = Role::create(['name' => 'Office Manager']);
        $employee = Role::create(['name' => 'Employee']);

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
