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
        Permission::create(['name' => 'edit organizations']);
        Permission::create(['name' => 'delete organizations']);
        Permission::create(['name' => 'publish organizations']);
        Permission::create(['name' => 'unpublish organizations']);

        Permission::create(['name' => 'assign roles']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'editor'])
            ->givePermissionTo(['edit organizations', 'publish organizations']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        // Assign super-admin to User 1
        $user = User::find(1);
        $user->assignRole('super-admin');
    }
}
