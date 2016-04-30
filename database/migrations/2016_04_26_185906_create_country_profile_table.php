<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryProfileTable extends Migration
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
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');

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
            $table->dropForeign('profiles_country_id_foreign');
            $table->dropColumn('country_id');
        });

    }
}
