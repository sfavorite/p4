<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::create('profiles', function (Blueprint $table) {
             $table->increments('id');
             $table->timestamps();
             $table->integer('user_id')->unsigned();
             $table->text('first');
             $table->text('last');
             $table->integer('ip_address')->unsigned(); // inet_pton inet_ntop
        //     $table->integer('city_id')->unsigned()->nullable;
        //     $table->integer('country_id')->unsigned()->nullable;

             # Make fogeign keys
             $table->foreign('user_id')->references('id')->on('Users');

       });
         //
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('profiles');
     }
}
