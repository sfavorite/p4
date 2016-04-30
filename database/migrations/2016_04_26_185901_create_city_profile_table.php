<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        # Make foregin keys
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('Cities');

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
            $table->dropForeign('profiles_city_id_foreign');
            $table->dropColumn('city_id');
        });

    }
}
