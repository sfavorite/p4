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
             $table->text('image');
             $table->integer('city_id')->unsigned()->nullable();


             # Make fogeign keys
             $table->foreign('user_id')->references('id')->on('users');
             $table->foreign('city_id')->references('id')->on('cities');


        });

    }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('profiles', function (Blueprint $table) {
             $table->dropForeign('profiles_user_id_foreign');
             $table->dropColumn('user_id');
             
             $table->dropForeign('profiles_city_id_foreign');
             $table->dropColumn('city_id');
         });



         Schema::drop('profiles');
     }
}
