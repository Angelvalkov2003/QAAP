<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('regions')->insert([
            ['name' => 'EMEA'],
            ['name' => 'AMS'],
            ['name' => 'APAC'],
        ]);
    }
}
