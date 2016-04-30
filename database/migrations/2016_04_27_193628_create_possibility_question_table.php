<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossibilityQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('possibility_question', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            # city_id and country_id will be foreign keys, so they have to be unsigned
            $table->integer('question_id')->unsigned();
            $table->integer('possibility_id')->unsigned();

            # Make foregin keys
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('possibility_id')->references('id')->on('possibilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('possibility_question');
    }
}
