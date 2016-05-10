<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question' => 'Who will win the election',
            'category_id' => 3,
            'open' => 1,
        ]);

        DB::table('questions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question' => 'Who will win the World Series',
            'category_id' => 2,
            'open' => 1,
        ]);
        DB::table('questions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question' => 'Which is the best TV Show',
            'category_id' => 7,
            'open' => 1,
        ]);
        DB::table('questions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question' => 'Which is better London or Paris',
            'category_id' => 8,
            'open' => 1,
        ]);
        DB::table('questions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question' => 'Do you eat popcorn at the movies',
            'category_id' => 7,
            'open' => 1,
        ]);
        DB::table('questions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question' => 'What time do you get up',
            'category_id' => 1,
            'open' => 1,
        ]);
        DB::table('questions')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question' => 'Is Global warming man made',
            'category_id' => 3,
            'open' => 1,
        ]);

    }
}
