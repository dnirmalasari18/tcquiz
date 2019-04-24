<?php

use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for ($i = 1; $i <= 1; $i++) {
			DB::table('users')->insert([                
				'username' => 'admin',
				'password' => bcrypt('admin'),
				'name' => 'admin',
				'role' => 'Admin',
			]);      
		}
    }
}
