<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_channel_consists_of_tasks()
    {
        $channel = create('App\Channel');
        $task = create('App\Task', ['channel_id' => $channel->id]);

        $this->assertTrue($channel->tasks->contains($task));
    }
}
