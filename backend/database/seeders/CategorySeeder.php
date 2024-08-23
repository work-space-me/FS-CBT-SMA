<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            'name' => 'Bahasa',
            'slug' => 'bahasa',
            'updated_at' =>Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Biology',
            'slug' => 'biology',
            'updated_at' =>Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Matematika',
            'slug' => 'matematika',
            'updated_at' =>Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
