<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscribeToTasksTest extends TestCase
{
    use DatabaseMigrations;

    /** @test Created on 26/05/2017 */
    function a_user_can_subscribe_to_tasks()
    {
        $this->signIn();

        $task = create('App\Task');

        $this->post($task->path() . '/subscriptions');

        $this->assertCount(1, $task->fresh()->subscriptions);
    }

    /** @test Created on 27/05/2017 */
    function a_user_can_unsubscribe_from_tasks()
    {
        $this->signIn();

        $task = create('App\Task');

        $task->subscribe();

        $this->delete($task->path() . '/subscriptions');

        $this->assertCount(0, $task->subscriptions);
    }
}