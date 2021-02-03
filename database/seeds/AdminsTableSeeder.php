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
		// USERS
		$admin = new \Matthv\Skeletor\Models\Admin();
		$admin->name 	= 'Admin';
		$admin->email 	= 'admin@skeletor.com';
        $admin->password = bcrypt('admin');
		$admin->save();
	}
}
