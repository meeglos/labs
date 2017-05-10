<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadTaskTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->task = factory('App\Task')->create();
    }

    /** @test */
    public function a_user_can_view_all_tasks()
    {
        $this->get('/tasks')
            ->assertSee($this->task->description);
    }

    /** @test */
    public function a_user_can_read_a_single_task()
    {
        $this->get($this->task->path())
            ->assertSee($this->task->description);
    }

    /** @test */
    public function a_user_can_read_posts_associated_with_a_task()
    {
        $post = create('App\Post', ['task_id' => $this->task->id]);

        $this->get($this->task->path())
            ->assertSee($post->comments);
    }

    /** @test */
    public function a_user_can_filter_tasks_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $taskInChannel = create('App\Task', ['channel_id' => $channel->id]);
        $taskNotInChannel =  create('App\Task');

        $this->get('/tasks/' . $channel->slug)
            ->assertSee($taskInChannel->description)
            ->assertDontSee($taskNotInChannel->description);
    }
}
