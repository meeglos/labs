<?php

namespace Tests\Unit;

use App\Activity;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_records_activity_when_a_task_is_created()
    {
        $this->signIn();

        $task = create('App\Task');

        $this->assertDatabaseHas('activities', [
            'type' => 'created_task',
            'user_id' => auth()->id(),
            'subject_id' => $task->id,
            'subject_type' => 'App\Task'
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $task->id);
    }

    /** @test */
    function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $post = create('App\Post');

        $this->assertEquals(2,Activity::count());
    }

    /** @test */
    function it_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        create('App\Task', [
            'user_id'   =>  auth()->id(),
            'created_at'    =>  Carbon::now()->subWeek()
        ]);

        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));
    }
}
