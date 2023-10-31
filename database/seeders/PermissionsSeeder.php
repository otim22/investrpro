<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use \App\Models\User;

class PermissionsSeeder extends Seeder
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
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'approve']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'customer']);
        $role1->givePermissionTo('edit');
        $role1->givePermissionTo('view');
        $role1->givePermissionTo('delete');

        // create roles and assign existing permissions
        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('view');
        $role2->givePermissionTo('approve');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = User::factory()->create([
            'first_name' => 'Lee',
            'last_name' => 'Hong',
            'company_name' => 'Merchantile limited',
            'email' => 'customer@example.com',
        ]);
        $user->assignRole($role1);

        $user = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Jannie',
            'company_name' => 'John deer corp',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'first_name' => 'Super-admin',
            'last_name' => 'Deere',
            'company_name' => 'John deer corp',
            'email' => 'super@example.com',
        ]);
        $user->assignRole($role3);
    }
}
