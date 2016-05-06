<?php

use Illuminate\Database\Seeder;

class PossibilityQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_id = \AnswerMe\Question::where('question', '=', 'who will win the world series')->pluck('id')->first();
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 1,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 2,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 3,
        ]);

        $question_id = \AnswerMe\Question::where('question', '=', 'who will win the election')->pluck('id')->first();
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 4,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 5,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 6,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'which is the best tv show')->pluck('id')->first();
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 7,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 8,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'Which is better London or Paris')->pluck('id')->first();
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 8,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 9,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'Do you eat popcorn at the movies')->pluck('id')->first();
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 10,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 11,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'What time do you get up')->pluck('id')->first();
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 12,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 13,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 14,
        ]);
        $question_id = \AnswerMe\Question::where('question', '=', 'Is Global warming man made')->pluck('id')->first();
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 10,
        ]);
        DB::table('possibility_question')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'question_id' => $question_id,
            'possibility_id' => 11,
        ]);


    }
}
