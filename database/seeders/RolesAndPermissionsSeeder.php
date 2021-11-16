<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        // View extra data for registered users
        Permission::create(['name' => 'view data']);

        // Organizations CRUD
        Permission::create(['name' => 'edit organizations']);
        Permission::create(['name' => 'delete organizations']);
        Permission::create(['name' => 'publish organizations']);
        Permission::create(['name' => 'unpublish organizations']);

        // Users and roles
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'assign roles']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'super-admin']);

        $role->givePermissionTo(Permission::all());

        Role::create(['name' => 'editor'])
            ->givePermissionTo(['edit organizations', 'publish organizations']);

        Role::create(['name' => 'user'])
            ->givePermissionTo(['view data']);

        // Assign super-admin to User 1
        $user = User::find(1);
        $user->assignRole('super-admin');
    }
}
