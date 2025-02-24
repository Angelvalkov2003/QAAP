<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Models\Folder;
use App\Models\Region;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TaskCreateTest extends TestCase
{

    #[Test]
    public function test_user_can_see_create_task_page_with_required_data()
    {

        $user = User::factory()->create();
        $this->actingAs($user);


        $task = Task::factory()->create(['user_id' => $user->id]);
        $folder = Folder::factory()->create(['user_id' => $user->id]);


        $regions = Region::all();
        $statuses = Status::all();

        $response = $this->get(route('tasks.create'));

        $response->assertStatus(200);

        $response->assertViewIs('tasks.create');

        $response->assertViewHas('tasks');
        $response->assertViewHas('regions');
        $response->assertViewHas('statuses');
        $response->assertViewHas('users');
        $response->assertViewHas('folders');

        $response->assertViewHas('tasks', function ($tasks) use ($user) {
            return $tasks->first()->user_id === $user->id; //Функцията проверява дали първата задача, която е върната от tasks, принадлежи на потребителя, който е логнат
        });

        $response->assertViewHas('folders', function ($folders) use ($user) {
            return $folders->first()->user_id === $user->id;
        });

        $response->assertViewHas('regions', function ($regionsInView) use ($regions) {
            return $regionsInView->pluck('name')->diff($regions->pluck('name'))->isEmpty(); //проверява дали в изгледа са включени всички региони от базата данни
        });

        $response->assertViewHas('statuses', function ($statusesInView) use ($statuses) {
            return $statusesInView->pluck('name')->diff($statuses->pluck('name'))->isEmpty();
        });
    }
}
