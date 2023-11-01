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
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'approve']);

        // create roles and assign existing permissions
        $ordinaryMemberRole = Role::create(['name' => 'ordinary-member']);
        $ordinaryMemberRole->givePermissionTo('view');
        
        // create roles and assign existing permissions
        $executiveMemberRole = Role::create(['name' => 'executive-member']);
        $executiveMemberRole->givePermissionTo('view');
        
        // create roles and assign existing permissions
        $chairpersonRole = Role::create(['name' => 'chairperson']);
        $chairpersonRole->givePermissionTo('view');
        $chairpersonRole->givePermissionTo('edit');
        $chairpersonRole->givePermissionTo('approve');
        
        // create roles and assign existing permissions
        $treasurerRole = Role::create(['name' => 'treasurer']);
        $treasurerRole->givePermissionTo('view');
        $treasurerRole->givePermissionTo('edit');
        
        // create roles and assign existing permissions
        $financeRole = Role::create(['name' => 'finance']);
        $financeRole->givePermissionTo('view');
        $financeRole->givePermissionTo('edit');
        
        // create roles and assign existing permissions
        $auditorRole = Role::create(['name' => 'auditor']);
        $auditorRole->givePermissionTo('view');
        $auditorRole->givePermissionTo('approve');

        // create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view');
        $adminRole->givePermissionTo('edit');
        $adminRole->givePermissionTo('delete');
        $adminRole->givePermissionTo('approve');

        $superAdminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $member = User::factory()->create([
            'first_name' => 'Member',
            'last_name' => 'Lee',
            'company_name' => 'Alibaba limited',
            'email' => 'member@gmail.com',
        ]);
        $member->assignRole($ordinaryMemberRole);
        
        $executive = User::factory()->create([
            'first_name' => 'Executive',
            'last_name' => 'Hong',
            'company_name' => 'Merchantile limited',
            'email' => 'executive@gmail.com',
        ]);
        $executive->assignRole($executiveMemberRole);

        $chairperson = User::factory()->create([
            'first_name' => 'Chairperson',
            'last_name' => 'Refwanye',
            'company_name' => 'Meta corp',
            'email' => 'chairperson@gmail.com',
        ]);
        $chairperson->assignRole($chairpersonRole);

        $treasurer = User::factory()->create([
            'first_name' => 'Treasurer',
            'last_name' => 'Tim',
            'company_name' => 'Deer corp',
            'email' => 'treasurer@gmail.com',
        ]);
        $treasurer->assignRole($treasurerRole);

        $finance = User::factory()->create([
            'first_name' => 'Finance',
            'last_name' => 'Alexis',
            'company_name' => 'Xero llc',
            'email' => 'finance@gmail.com',
        ]);
        $finance->assignRole($financeRole);

        $auditor = User::factory()->create([
            'first_name' => 'Auditor',
            'last_name' => 'Jannie',
            'company_name' => 'OpenID llc',
            'email' => 'auditor@gmail.com',
        ]);
        $auditor->assignRole($auditorRole);

        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Jamal',
            'company_name' => 'Stancyl ltd',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assignRole($adminRole);

        $superAdmin = User::factory()->create([
            'first_name' => 'Super-admin',
            'last_name' => 'Deere',
            'company_name' => 'Morgan ltd',
            'email' => 'super@gmail.com',
        ]);
        $superAdmin->assignRole($superAdminRole);
    }
}
