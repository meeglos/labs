<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_may_not_create_tasks()
    {
        $this->withExceptionHandling();

        $this->get('/tasks/create')
            ->assertRedirect('/login');

        $this->post('/tasks')
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_can_create_new_tasks()
    {
        $this->signIn();

        $task = create('App\Task');

        $this->post('/tasks', $task->toArray());

        $this->get($task->path())
            ->assertSee($task->description)
            ->assertSee($task->client_name);
    }
}
