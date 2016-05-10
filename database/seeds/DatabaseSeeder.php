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
        echo 'QuestionTable' . PHP_EOL;
        $this->call(QuestionTableSeeder::class);
        echo 'Profiles' . PHP_EOL;
        $this->call(ProfilesTableSeeder::class);
        echo 'Possibilities' . PHP_EOL;
        $this->call(PossibilitiesTableSeeder::class);
        echo 'QuestionUser' . PHP_EOL;
        $this->call(QuestionUserTableSeeder::class);
        echo 'PossibilityQuestion' . PHP_EOL;
        $this->call(PossibilityQuestionTableSeeder::class);
        $this->call(OpinionsTableSeeder::class);
    }
}
