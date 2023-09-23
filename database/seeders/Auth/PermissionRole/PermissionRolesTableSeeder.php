<?php
namespace Database\Seeders\Auth\PermissionRole;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Database\Seeders\Traits\DisableForeignKeys;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRolesTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'View']);
        Permission::create(['name' => 'Create']);
        Permission::create(['name' => 'Edit']);
        Permission::create(['name' => 'Delete']);
        Permission::create(['name' => 'Disable']);

        // Create Roles
        Role::create(['name' => 'Superadmin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Client']);
    }
}
