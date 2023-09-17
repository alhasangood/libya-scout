<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list donations']);
        Permission::create(['name' => 'view donations']);
        Permission::create(['name' => 'create donations']);
        Permission::create(['name' => 'update donations']);
        Permission::create(['name' => 'delete donations']);

        Permission::create(['name' => 'list alldonationdetales']);
        Permission::create(['name' => 'view alldonationdetales']);
        Permission::create(['name' => 'create alldonationdetales']);
        Permission::create(['name' => 'update alldonationdetales']);
        Permission::create(['name' => 'delete alldonationdetales']);

        Permission::create(['name' => 'list donationentities']);
        Permission::create(['name' => 'view donationentities']);
        Permission::create(['name' => 'create donationentities']);
        Permission::create(['name' => 'update donationentities']);
        Permission::create(['name' => 'delete donationentities']);

        Permission::create(['name' => 'list items']);
        Permission::create(['name' => 'view items']);
        Permission::create(['name' => 'create items']);
        Permission::create(['name' => 'update items']);
        Permission::create(['name' => 'delete items']);

        Permission::create(['name' => 'list allitemdetails']);
        Permission::create(['name' => 'view allitemdetails']);
        Permission::create(['name' => 'create allitemdetails']);
        Permission::create(['name' => 'update allitemdetails']);
        Permission::create(['name' => 'delete allitemdetails']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list rolls']);
        Permission::create(['name' => 'view rolls']);
        Permission::create(['name' => 'create rolls']);
        Permission::create(['name' => 'update rolls']);
        Permission::create(['name' => 'delete rolls']);

        Permission::create(['name' => 'list scoutcommissions']);
        Permission::create(['name' => 'view scoutcommissions']);
        Permission::create(['name' => 'create scoutcommissions']);
        Permission::create(['name' => 'update scoutcommissions']);
        Permission::create(['name' => 'delete scoutcommissions']);

        Permission::create(['name' => 'list scoutregiments']);
        Permission::create(['name' => 'view scoutregiments']);
        Permission::create(['name' => 'create scoutregiments']);
        Permission::create(['name' => 'update scoutregiments']);
        Permission::create(['name' => 'delete scoutregiments']);

        Permission::create(['name' => 'list storehouses']);
        Permission::create(['name' => 'view storehouses']);
        Permission::create(['name' => 'create storehouses']);
        Permission::create(['name' => 'update storehouses']);
        Permission::create(['name' => 'delete storehouses']);

        Permission::create(['name' => 'list transprters']);
        Permission::create(['name' => 'view transprters']);
        Permission::create(['name' => 'create transprters']);
        Permission::create(['name' => 'update transprters']);
        Permission::create(['name' => 'delete transprters']);

        Permission::create(['name' => 'list transprtertypes']);
        Permission::create(['name' => 'view transprtertypes']);
        Permission::create(['name' => 'create transprtertypes']);
        Permission::create(['name' => 'update transprtertypes']);
        Permission::create(['name' => 'delete transprtertypes']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
