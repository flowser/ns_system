<?php
namespace Database\Seeders\Auth\PermissionRole;


use App\Models\User\User;
use Illuminate\Database\Seeder;


class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Fetch the first user
        $firstUser = User::orderBy('created_at')->first();
        $firstUser->assignRole('Superadmin');
        $firstUser->givePermissionTo(
            [
                'View',
                'Create',
                'Edit',
                'Delete',
                'Disable'
            ]
        );

        // Fetch the second user
        $secondUser = User::orderBy('created_at')->skip(1)->take(1)->first();
        $secondUser->assignRole('Admin');
        $secondUser->givePermissionTo(
            [
                'View',
                'Create',
                'Edit',
                'Delete',
                'Disable'
            ]
        );

        // Fetch the third user
        $thirdUser = User::orderBy('created_at')->skip(2)->take(1)->first();
        $thirdUser->assignRole('Client');
        $thirdUser->givePermissionTo(
            [
                'View',
                'Create',
                'Delete',
            ]
        );
    }
}
