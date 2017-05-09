<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInLabsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_comments()
    {
        $this->withExceptionHandling()
            ->post('/tasks/some-channel/1/posts', [])
            ->assertRedirect('/login');
    }
    /** @test */
    public function an_authenticated_user_may_participate_in_lab_tasks()
    {
        $this->signIn();

        $task = create('App\Task');
        $post = make('App\Post');

        $this->post($task->path() .'/posts', $post->toArray());

        $this->get($task->path())
            ->assertSee($post->comments);

    }
    /** @test */
    public function a_post_requires_a_comment()
    {
        $this->withExceptionHandling()->signIn();

        $task = create('App\Task');
        $post = make('App\Post', ['comments' => null]);

        $this->post($task->path() .'/posts', $post->toArray())
            ->assertSessionHasErrors('comments');

    }
}
