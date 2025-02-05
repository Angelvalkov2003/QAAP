<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Създаване на една задача ръчно
        Task::create([
            'label' => 'Примерна задача',
            'description' => 'Това е тестова задача',
            'region_id' => 1,
            'user_id' => 1,
            'status_id' => 1,
        ]);
        // Генериране на 10 задачи чрез фабрика
        //Task::factory(10)->create();
    }
}
