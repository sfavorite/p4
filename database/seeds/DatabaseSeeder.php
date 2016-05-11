<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(PossibilitiesTableSeeder::class);
        $this->call(QuestionUserTableSeeder::class);
        $this->call(PossibilityQuestionTableSeeder::class);
        $this->call(OpinionsTableSeeder::class);
    }
}
