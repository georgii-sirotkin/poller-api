<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text');
            $table->bigInteger('multiple_choice_question_id')->unsigned();
            $table->boolean('is_other');
            $table->timestamps();

            $table->foreign('multiple_choice_question_id')
                ->references('id')->on('multiple_choice_questions')
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
        Schema::dropIfExists('answer_options');
    }
}
