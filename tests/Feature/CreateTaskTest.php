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

        $task = make('App\Task');

        $response = $this->post('/tasks', $task->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($task->description)
            ->assertSee($task->client_name);
    }

    /** @test */
    function a_task_requires_a_description()
    {
        $this->publishTask(['description' => null])
            ->assertSessionHasErrors('description');
    }

   /** @test */
    function a_task_requires_a_client_name()
    {
        $this->publishTask(['client_name' => null])
            ->assertSessionHasErrors('client_name');
    }

   /** @test */
    function a_task_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishTask(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishTask(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishTask($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $task = make('App\Task', $overrides);

        return $this->post('/tasks', $task->toArray());
    }
}
