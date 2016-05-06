<?php

use Illuminate\Database\Seeder;

class PossibilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Cleveland Indians',
        ]);

        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Mets',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'New York Yankees',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Sanders',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Trump',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Cruz',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'The Black List',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'London',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Paris',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Yes',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'No',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => '7 AM',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => '8 AM',
        ]);
        DB::table('possibilities')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'instance' => 'Noon',
        ]);
    }
}
