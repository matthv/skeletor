<?php

namespace Matthv\Skeletor\Database\Seeds;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// ROLES
    	$roles = ['super_admin', 'admin'];
    	foreach($roles as $r) {
			$role = new \Matthv\Skeletor\App\Models\DashboardRole();
			$role->name = $r;
			$role->save();
		}

		$role_superadmin 	= \Matthv\Skeletor\App\Models\DashboardRole::where('name', 'super_admin')->first();
		$role_admin 		= \Matthv\Skeletor\App\Models\DashboardRole::where('name', 'admin')->first();

		// USERS
		$admin = new \Matthv\Skeletor\App\Models\Admin();
		$admin->name 	= 'Admin';
		$admin->email 	= 'admin@skeletor.com';
		$admin->password = 'admin';
		$admin->save();
		$admin->roles()->attach([$role_superadmin->id, $role_admin->id]);
	}
}
