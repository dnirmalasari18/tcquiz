<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kuis');
            $table->integer('durasi');
            $table->longText('terms_conditions')->nullable();
            $table->integer('absenkuliah_id')->unsigned();
            $table->integer('dosen_id')->unsigned();
            $table->string('finalize_status',1)->default('0');
            $table->timestamps();
        });

        Schema::table('quizzes',function($table) {
            $table->foreign('absenkuliah_id')
            ->references('id')
            ->on('absenkuliah')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('dosen_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('quizzes');
    }
}
