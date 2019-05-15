<?php

use Illuminate\Database\Seeder;

class MahasiswaPacketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswaPackets = array();
        for($i=0;$i<100;$i++){
            array_push($mahasiswaPackets, [
                'user_id' => mt_rand(10,39),
                'quizpacket_id' => 55,
                'question_flag_list' => "0,0,0,0,0,0,0,0,0,0,0,0,0",
                'user_answer_list' => "0,1,2,0,1,2,0,1,2,0,1,2,0",
                'quiz_score' => mt_rand(0,100),
                'status_ambil' => 1,
            ]);
        }
        DB::table('mahasiswa_packets')->insert($mahasiswaPackets);
    }
}
