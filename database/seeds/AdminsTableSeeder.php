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
			$role = new \Matthv\Skeletor\Models\DashboardRole();
			$role->name = $r;
			$role->save();
		}

		$role_superadmin 	= \Matthv\Skeletor\Models\DashboardRole::where('name', 'super_admin')->first();
		$role_admin 		= \Matthv\Skeletor\Models\DashboardRole::where('name', 'admin')->first();

		// USERS
		$admin = new \Matthv\Skeletor\Models\Admin();
		$admin->name 	= 'Admin';
		$admin->email 	= 'admin@skeletor.com';
        $admin->password = bcrypt('admin');
		$admin->save();
		$admin->roles()->attach([$role_superadmin->id, $role_admin->id]);
	}
}
