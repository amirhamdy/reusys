<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list contacts']);
        Permission::create(['name' => 'view contacts']);
        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'update contacts']);
        Permission::create(['name' => 'delete contacts']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list currencies']);
        Permission::create(['name' => 'view currencies']);
        Permission::create(['name' => 'create currencies']);
        Permission::create(['name' => 'update currencies']);
        Permission::create(['name' => 'delete currencies']);

        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

        Permission::create(['name' => 'list customerratings']);
        Permission::create(['name' => 'view customerratings']);
        Permission::create(['name' => 'create customerratings']);
        Permission::create(['name' => 'update customerratings']);
        Permission::create(['name' => 'delete customerratings']);

        Permission::create(['name' => 'list customerstatuses']);
        Permission::create(['name' => 'view customerstatuses']);
        Permission::create(['name' => 'create customerstatuses']);
        Permission::create(['name' => 'update customerstatuses']);
        Permission::create(['name' => 'delete customerstatuses']);

        Permission::create(['name' => 'list industries']);
        Permission::create(['name' => 'view industries']);
        Permission::create(['name' => 'create industries']);
        Permission::create(['name' => 'update industries']);
        Permission::create(['name' => 'delete industries']);

        Permission::create(['name' => 'list jobs']);
        Permission::create(['name' => 'view jobs']);
        Permission::create(['name' => 'create jobs']);
        Permission::create(['name' => 'update jobs']);
        Permission::create(['name' => 'delete jobs']);

        Permission::create(['name' => 'list jobtypes']);
        Permission::create(['name' => 'view jobtypes']);
        Permission::create(['name' => 'create jobtypes']);
        Permission::create(['name' => 'update jobtypes']);
        Permission::create(['name' => 'delete jobtypes']);

        Permission::create(['name' => 'list jobunits']);
        Permission::create(['name' => 'view jobunits']);
        Permission::create(['name' => 'create jobunits']);
        Permission::create(['name' => 'update jobunits']);
        Permission::create(['name' => 'delete jobunits']);

        Permission::create(['name' => 'list languages']);
        Permission::create(['name' => 'view languages']);
        Permission::create(['name' => 'create languages']);
        Permission::create(['name' => 'update languages']);
        Permission::create(['name' => 'delete languages']);

        Permission::create(['name' => 'list opportunities']);
        Permission::create(['name' => 'view opportunities']);
        Permission::create(['name' => 'create opportunities']);
        Permission::create(['name' => 'update opportunities']);
        Permission::create(['name' => 'delete opportunities']);

        Permission::create(['name' => 'list opportunitytypes']);
        Permission::create(['name' => 'view opportunitytypes']);
        Permission::create(['name' => 'create opportunitytypes']);
        Permission::create(['name' => 'update opportunitytypes']);
        Permission::create(['name' => 'delete opportunitytypes']);

        Permission::create(['name' => 'list opportunityunits']);
        Permission::create(['name' => 'view opportunityunits']);
        Permission::create(['name' => 'create opportunityunits']);
        Permission::create(['name' => 'update opportunityunits']);
        Permission::create(['name' => 'delete opportunityunits']);

        Permission::create(['name' => 'list portals']);
        Permission::create(['name' => 'view portals']);
        Permission::create(['name' => 'create portals']);
        Permission::create(['name' => 'update portals']);
        Permission::create(['name' => 'delete portals']);

        Permission::create(['name' => 'list pricebooks']);
        Permission::create(['name' => 'view pricebooks']);
        Permission::create(['name' => 'create pricebooks']);
        Permission::create(['name' => 'update pricebooks']);
        Permission::create(['name' => 'delete pricebooks']);

        Permission::create(['name' => 'list pricelists']);
        Permission::create(['name' => 'view pricelists']);
        Permission::create(['name' => 'create pricelists']);
        Permission::create(['name' => 'update pricelists']);
        Permission::create(['name' => 'delete pricelists']);

        Permission::create(['name' => 'list productlines']);
        Permission::create(['name' => 'view productlines']);
        Permission::create(['name' => 'create productlines']);
        Permission::create(['name' => 'update productlines']);
        Permission::create(['name' => 'delete productlines']);

        Permission::create(['name' => 'list projects']);
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'update projects']);
        Permission::create(['name' => 'delete projects']);

        Permission::create(['name' => 'list regions']);
        Permission::create(['name' => 'view regions']);
        Permission::create(['name' => 'create regions']);
        Permission::create(['name' => 'update regions']);
        Permission::create(['name' => 'delete regions']);

        Permission::create(['name' => 'list subjectmatters']);
        Permission::create(['name' => 'view subjectmatters']);
        Permission::create(['name' => 'create subjectmatters']);
        Permission::create(['name' => 'update subjectmatters']);
        Permission::create(['name' => 'delete subjectmatters']);

        Permission::create(['name' => 'list task']);
        Permission::create(['name' => 'view task']);
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'update task']);
        Permission::create(['name' => 'delete task']);

        Permission::create(['name' => 'list tasktypes']);
        Permission::create(['name' => 'view tasktypes']);
        Permission::create(['name' => 'create tasktypes']);
        Permission::create(['name' => 'update tasktypes']);
        Permission::create(['name' => 'delete tasktypes']);

        Permission::create(['name' => 'list taskunits']);
        Permission::create(['name' => 'view taskunits']);
        Permission::create(['name' => 'create taskunits']);
        Permission::create(['name' => 'update taskunits']);
        Permission::create(['name' => 'delete taskunits']);

        Permission::create(['name' => 'list translators']);
        Permission::create(['name' => 'view translators']);
        Permission::create(['name' => 'create translators']);
        Permission::create(['name' => 'update translators']);
        Permission::create(['name' => 'delete translators']);

        Permission::create(['name' => 'list translatorpricelists']);
        Permission::create(['name' => 'view translatorpricelists']);
        Permission::create(['name' => 'create translatorpricelists']);
        Permission::create(['name' => 'update translatorpricelists']);
        Permission::create(['name' => 'delete translatorpricelists']);

        Permission::create(['name' => 'list translatortypes']);
        Permission::create(['name' => 'view translatortypes']);
        Permission::create(['name' => 'create translatortypes']);
        Permission::create(['name' => 'update translatortypes']);
        Permission::create(['name' => 'delete translatortypes']);

//        Permission::create(['name' => 'list banks']);
//        Permission::create(['name' => 'view banks']);
//        Permission::create(['name' => 'create banks']);
//        Permission::create(['name' => 'update banks']);
//        Permission::create(['name' => 'delete banks']);

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

        // TODO: remove super-user role form each user
        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $users = User::all();

        foreach ($users as $user) {
            $user->assignRole($adminRole);
        }
    }
}
