<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['name' => 'Estimate'],
            ['name' => 'Initial Check'],
            ['name' => 'Programmer review'],
            ['name' => 'Changes'],
            ['name' => 'Closed'],
        ]);
    }
}
