<?php

use Illuminate\Database\Seeder;

class QuestionUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_id = \AnswerMe\Question::where('question', '=', 'who will win the world series')->pluck('id')->first();
        DB::table('question_user')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'user_id' => 1,
        ]);

        $question_id = \AnswerMe\Question::where('question', '=', 'who will win the election')->pluck('id')->first();
        DB::table('question_user')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'user_id' => 2,
        ]);

        $question_id = \AnswerMe\Question::where('question', '=', 'which is the best tv show')->pluck('id')->first();
        DB::table('question_user')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'user_id' => 2,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'Which is better London or Paris')->pluck('id')->first();
        DB::table('question_user')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'user_id' => 2,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'Do you eat popcorn at the movies')->pluck('id')->first();
        DB::table('question_user')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'user_id' => 2,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'What time do you get up')->pluck('id')->first();
        DB::table('question_user')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'user_id' => 1,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'Is Global warming man made')->pluck('id')->first();
        DB::table('question_user')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'user_id' => 1,
        ]);
    }
}
