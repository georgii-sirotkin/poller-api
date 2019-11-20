<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedAnswerOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_answer_options', function (Blueprint $table) {
            $table->bigInteger('answer_option_id')->unsigned();
            $table->bigInteger('multiple_choice_answer_id')->unsigned();
            $table->timestamps();

            $table->unique(['answer_option_id', 'multiple_choice_answer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selected_answer_options');
    }
}
