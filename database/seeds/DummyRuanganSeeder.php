<?php

use Illuminate\Database\Seeder;

class DummyRuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            $name = 'IF-10'.$i;

            DB::table('ruangans')->insertGetId([                
                'nama_ruangan' => $name,
                'kuota_ruangan' => '35'
            ]);
        }

        DB::table('ruangans')->insertGetId([                
                'nama_ruangan' => 'IF-105A',
                'kuota_ruangan' => '35'
            ]);
        DB::table('ruangans')->insertGetId([                
                'nama_ruangan' => 'IF-105B',
                'kuota_ruangan' => '35'
            ]);
        DB::table('ruangans')->insertGetId([                
                'nama_ruangan' => 'IF-106',
                'kuota_ruangan' => '35'
            ]);
        DB::table('ruangans')->insertGetId([                
                'nama_ruangan' => 'IF-107A',
                'kuota_ruangan' => '35'
            ]);
        DB::table('ruangans')->insertGetId([                
                'nama_ruangan' => 'IF-107B',
                'kuota_ruangan' => '35'
            ]);
        DB::table('ruangans')->insertGetId([                
                'nama_ruangan' => 'IF-108',
                'kuota_ruangan' => '35'
            ]);

    }
}
