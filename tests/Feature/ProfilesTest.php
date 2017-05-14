<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_has_a_profile()
    {
        $user = create('App\User');

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    function profiles_display_all_tasks_created_by_the_associated_user()
    {
        $user = create('App\User');

        $task = create('App\Task', ['user_id' => $user->id]);
//dd($task);
        $this->get("/profiles/{$user->name}")
            ->assertSee($task->description)
            ->assertSee($task->client_name);

    }
}
