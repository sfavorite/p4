<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'General',
            'font' => 'fa fa-3x fa-check',
        ]);
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'Sports',
            'font' => 'fa fa-3x fa-futbol-o',
        ]);
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'Politics',
            'font' => 'fa fa-3x fa-university',
        ]);
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'Health',
            'font' => 'fa fa-3x fa-medkit',
        ]);
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'Religion',
            'font' => 'fa fa-3x fa-heart',
        ]);
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'Education',
            'font' => 'fa fa-3x fa-graduation-cap',
        ]);
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'Entertainment',
            'font' => 'fa fa-3x fa-music',
        ]);
        DB::table('categories')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'type' => 'Travel',
            'font' => 'fa fa-3x fa-suitcase',
        ]);

    }
}
