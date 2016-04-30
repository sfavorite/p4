<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = \AnswerMe\User::where('name', '=', 'Jill')->pluck('id')->first();
        DB::table('profiles')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'first' => 'Jill',
            'last' => 'Ryhme',
            'user_id' => $user_id,
            'city_id' => null,
            'country_id' => '1',
        ]);
        $user_id = \AnswerMe\User::where('name', '=', 'Jamal')->pluck('id')->first();
        DB::table('profiles')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'first' => 'Jamal',
            'last' => 'Phillips',
            'user_id' => $user_id,
            'city_id' => '3',
            'country_id' => '2',
        ]);
    }
}
