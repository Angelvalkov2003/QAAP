<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Region;
use App\Models\Task;
use App\Models\Folder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class TaskIndexTest extends TestCase
{

    /** @test */
    public function test_user_can_see_their_tasks_and_folders_on_index()
    {

        $user = User::factory()->create();
        $this->actingAs($user);


        $response = $this->get(route('tasks.index'));


        $response->assertStatus(200);


        $response->assertViewIs('tasks.index');


        $response->assertViewHas('tasks');
    }

}
