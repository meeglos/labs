<?php

namespace Tests\Feature;

use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test Created on 27/05/2017 */
    function a_notification_is_prepared_when_a_subscribed_task_receives_a_new_post_that_is_not_by_the_current_user()
    {
        $task = create('App\Task')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $task->addComment([
            'user_id' => auth()->id(),
            'comments' => 'Some comment here'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $task->addComment([
            'user_id' => create('App\User')->id,
            'comments' => 'Some comment here'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test Created on 27/05/2017 */
    function a_user_can_fetch_their_unread_notifications()
    {
        create(DatabaseNotification::class);

        $user = auth()->user();

        $this->assertCount(1, $this->getJson("/profiles/{$user->name}/notifications")->json());
    }

    /** @test Created on 27/05/2017 */
    function a_user_can_mark_a_notification_as_read()
    {
        create(DatabaseNotification::class);

        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $notificationsId = auth()->user()->unreadNotifications->first()->id;

        $this->delete("/profiles/{$user->name}/notifications/{$notificationsId}");

        $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);
    }
}
