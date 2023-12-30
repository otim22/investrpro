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
        // Investment
        Permission::create(['name' => 'add investment']);
        Permission::create(['name' => 'view investment']);
        Permission::create(['name' => 'show investment actions']);
        Permission::create(['name' => 'update investment']);
        Permission::create(['name' => 'delete investment']);
        // Asset
        Permission::create(['name' => 'add asset']);
        Permission::create(['name' => 'view asset']);
        Permission::create(['name' => 'show asset actions']);
        Permission::create(['name' => 'update asset']);
        Permission::create(['name' => 'delete asset']);
        // expense
        Permission::create(['name' => 'add expense']);
        Permission::create(['name' => 'view expense']);
        Permission::create(['name' => 'show expense actions']);
        Permission::create(['name' => 'update expense']);
        Permission::create(['name' => 'delete expense']);
        // member
        Permission::create(['name' => 'add member']);
        Permission::create(['name' => 'view member']);
        Permission::create(['name' => 'show member actions']);
        Permission::create(['name' => 'update member']);
        Permission::create(['name' => 'delete member']);
        // next of kin
        Permission::create(['name' => 'add next of kin']);
        Permission::create(['name' => 'view next of kin']);
        Permission::create(['name' => 'show next of kin actions']);
        Permission::create(['name' => 'update next of kin']);
        Permission::create(['name' => 'delete next of kin']);
        // financial report
        Permission::create(['name' => 'add financial report']);
        Permission::create(['name' => 'view financial report']);
        Permission::create(['name' => 'show financial report actions']);
        Permission::create(['name' => 'update financial report']);
        Permission::create(['name' => 'delete financial report']);
        // audit report
        Permission::create(['name' => 'add audit report']);
        Permission::create(['name' => 'view audit report']);
        Permission::create(['name' => 'show audit report actions']);
        Permission::create(['name' => 'update audit report']);
        Permission::create(['name' => 'delete audit report']);
        // hr manual
        Permission::create(['name' => 'add hr manual']);
        Permission::create(['name' => 'view hr manual']);
        Permission::create(['name' => 'show hr manual actions']);
        Permission::create(['name' => 'update hr manual']);
        Permission::create(['name' => 'delete hr manual']);
        // user
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'show user actions']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // create roles and assign existing permissions
        $ordinaryMemberRole = Role::create(['name' => 'ordinary-member']);
        $ordinaryMemberRole->givePermissionTo('view investment');
        
        // create roles and assign existing permissions
        $executiveMemberRole = Role::create(['name' => 'executive-member']);
        $executiveMemberRole->givePermissionTo('view investment');
        
        // create roles and assign existing permissions
        $chairpersonRole = Role::create(['name' => 'chairperson']);
        $chairpersonRole->givePermissionTo('add investment');
        $chairpersonRole->givePermissionTo('view investment');
        $chairpersonRole->givePermissionTo('show investment actions');
        $chairpersonRole->givePermissionTo('update investment');
        $chairpersonRole->givePermissionTo('delete investment');
        
        // create roles and assign existing permissions
        $secretaryGeneralRole = Role::create(['name' => 'secretary-general']);
        $secretaryGeneralRole->givePermissionTo('add investment');
        $secretaryGeneralRole->givePermissionTo('view investment');
        $secretaryGeneralRole->givePermissionTo('show investment actions');
        $secretaryGeneralRole->givePermissionTo('update investment');

        // create roles and assign existing permissions
        $treasurerRole = Role::create(['name' => 'treasurer']);
        $treasurerRole->givePermissionTo('add investment');
        $treasurerRole->givePermissionTo('view investment');
        $treasurerRole->givePermissionTo('show investment actions');
        $treasurerRole->givePermissionTo('update investment');
        
        // create roles and assign existing permissions
        $auditorRole = Role::create(['name' => 'auditor']);
        $auditorRole->givePermissionTo('view investment');

        // create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view investment');
        $adminRole->givePermissionTo('add investment');
        $adminRole->givePermissionTo('show investment actions');
        $adminRole->givePermissionTo('delete investment');
        $adminRole->givePermissionTo('delete investment');

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

        $secretaryGeneral = User::factory()->create([
            'first_name' => 'Secretary',
            'last_name' => 'Alexis',
            'company_name' => 'Xero llc',
            'email' => 'secretary@gmail.com',
        ]);
        $secretaryGeneral->assignRole($secretaryGeneralRole);

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
            'first_name' => 'Super admin',
            'last_name' => 'Deere',
            'company_name' => 'Morgan ltd',
            'email' => 'super@gmail.com',
        ]);
        $superAdmin->assignRole($superAdminRole);
    }
}
