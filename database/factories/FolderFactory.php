<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FolderFactory extends Factory
{
    protected $model = Folder::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Може да използваш потребителски фабрика
            'name' => $this->faker->word(),
            'parent_id' => null, // или задайте по ваш избор
        ];
    }
}
