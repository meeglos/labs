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

        $this->assertDatabaseHas('posts', ['comments' => $post->comments]);
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

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));

        $taskByJohnDoe = create('App\Task', ['user_id' => auth()->id()]);
        $taskNotByJohnDoe = create('App\Task');

        $this->get('tasks?by=JohnDoe')
            ->assertSee($taskByJohnDoe->description)
            ->assertDontSee($taskNotByJohnDoe->description);
    }

    /** @test */
    function a_user_can_filter_tasks_by_popularity()
    {
        $taskWithTwoPosts = create('App\Task');
        create('App\Post', ['task_id' => $taskWithTwoPosts->id], 2);

        $taskWithTwoPosts = create('App\Task');
        create('App\Post', ['task_id' => $taskWithTwoPosts->id], 3);

        $taskWithNoPosts = $this->task;

        $response = $this->getJson('tasks?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'posts_count'));
    }

    /** @test Created on 26/05/2017 */
    function a_user_can_filtter_tasks_by_those_that_are_unanswered()
    {
        $task = create('App\Task');
        create('App\Post', ['task_id' => $task->id]);

        $response = $this->getJson('tasks?unanswered=1')->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    function a_user_can_request_all_posts_for_a_given_task()
    {
        $task = create('App\Task');

        create('App\Post', ['task_id' => $task->id], 2);

        $response = $this->getJson($task->path() . '/posts')->json();
//dd($response);
        $this->assertCount(2,$response['data']);
        $this->assertEquals(2,$response['total']);
    }
}
