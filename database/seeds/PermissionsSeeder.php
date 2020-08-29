<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		// Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();	

		$roleAdmin = Role::create(['name' => 'admin']);
		$roleWriter = Role::create(['name' => 'writer']);
		$roleGuest = Role::create(['name' => 'guest']);
		// create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($roleAdmin);

//        $user = Factory(App\User::class)->create([
//            'name' => 'Writer',
//            'email' => 'writer@example.com',
//            'password' => Hash::make('password'),
//        ]);
//        $user->assignRole($roleWriter);
//
//        $user = Factory(App\User::class)->create([
//            'name' => 'Guest',
//            'email' => 'guest@example.com',
//            'password' => Hash::make('password'),
//        ]);
//        $user->assignRole($roleGuest);

    }
}
