<?php

use Illuminate\Database\Seeder;

class OpinionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('opinions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'possibility_id' => 1,
            'user_id' => 1,
            'question_id' => 1,
        ]);

        DB::table('opinions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'possibility_id' => 2,
            'user_id' => 2,
            'question_id' => 2,
        ]);

        DB::table('opinions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'possibility_id' => 2,
            'user_id' => 3,
            'question_id' => 3,
        ]);


    }
}
