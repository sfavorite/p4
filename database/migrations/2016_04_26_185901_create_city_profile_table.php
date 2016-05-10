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
        echo 'adding profiles' . PHP_EOL;
        # Make foregin keys
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('Cities');

        });
        echo 'p done' . PHP_EOL;

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
