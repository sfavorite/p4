<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpinionsTabe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinions',function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('possibility_id')->unsigned();
            $table->integer('question_id')->unsigned();

            # Make foregin keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('possibility_id')->references('id')->on('possibilities');
            $table->foreign('question_id')->references('id')->on('questions');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('opinions');
    }
}
