<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quiz_id')->unsigned();
            $table->longText('question_description');
            $table->longText('option_1');
            $table->longText('option_2');
            $table->longText('option_3')->nullable();
            $table->longText('option_4')->nullable();
            $table->longText('option_5')->nullable();
            $table->string('correct_answer',1);
            $table->integer('question_score');
            $table->timestamps();
        });

        Schema::table('questions',function($table) {
            $table->foreign('quiz_id')
            ->references('id')
            ->on('quizzes')
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
        Schema::dropIfExists('questions');
    }
}