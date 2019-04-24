<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mata_kuliah_id', 20);
            $table->string('user_nip', 20);
            $table->integer('ruangan_id')->unsigned();
            $table->string('hari', 10);
            $table->string('jam', 20);
            $table->string('kelas', 1);
            $table->integer('kuota');
            $table->timestamps();
        });

        Schema::table('kelas',function($table){
            $table->foreign('mata_kuliah_id')
            ->references('id')
            ->on('mata_kuliahs')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('user_nip')
            ->references('username')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('ruangan_id')
            ->references('id')
            ->on('ruangans')
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
        Schema::dropIfExists('kelas');
    }
}
