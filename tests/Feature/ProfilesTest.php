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
        $this->signIn();

        $task = create('App\Task', ['user_id' => auth()->id()]);
//dd($task);
        $this->get("/profiles/" . auth()->user()->name)
            ->assertSee($task->description);

    }
}
