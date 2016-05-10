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
        echo 'Creating profiles';
         Schema::create('profiles', function (Blueprint $table) {
             $table->increments('id');
             $table->timestamps();
             $table->integer('user_id')->unsigned();
             $table->text('first');
             $table->text('last');
             $table->text('image');

             # Make fogeign keys
//             $table->foreign('user_id')->references('id')->on('Users');

       });
       Schema::table('profiles', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
       });
       echo 'Priles done.';
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
