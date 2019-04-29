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
            $table->longText('option_a');
            $table->longText('option_b');
            $table->longText('option_c')->nullable();
            $table->longText('option_d')->nullable();
            $table->longText('option_e')->nullable();
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
