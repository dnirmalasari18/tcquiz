<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 9; $i++) {
            $name = $faker->name;
            $nrp = '0511164000000'.$i;

            $user_id = DB::table('users')->insertGetId([                
                'username' => $nrp,
                'name' => $name,
                'password' => bcrypt('123456'),
                'role' => 'Mahasiswa'
            ]);
        }
        for ($i = 10; $i <= 99; $i++) {
            $name = $faker->name;
            $nrp = '051116400000'.$i;

            $user_id = DB::table('users')->insertGetId([                
                'username' => $nrp,
                'name' => $name,
                'password' => bcrypt('123456'),
                'role' => 'Mahasiswa'
            ]);
        }
        for ($i = 1; $i <= 9; $i++) {
            $name = $faker->name;
            $nip = 'dosen000'.$i;

            DB::table('users')->insertGetId([                
                'username' => $nip,
                'name' => $name,
                'password' => bcrypt('123456'),
                'role' => 'Dosen'
            ]);
        }
    }
}
