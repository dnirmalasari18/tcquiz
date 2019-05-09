<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_packets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->bigInteger('quizpacket_id')->unsigned();
            $table->longText('question_flag_list')->nullable();
            $table->longText('user_answer_list')->nullable();
            $table->integer('quiz_score')->nullable();
            $table->datetime('end_time')->nullable();
            $table->integer('status_ambil')->nullable();
            $table->timestamps();
        });

        Schema::table('mahasiswa_packets',function($table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('quizpacket_id')
            ->references('id')
            ->on('quiz_packets')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_packets');
    }
}
