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

    /** @test */
    function unauthorized_users_cannot_delete_posts()
    {
        $this->withExceptionHandling();

        $post = create('App\Post');

        $this->delete("/posts/{$post->id}")
            ->assertRedirect('login');

        $this->signIn()
            ->delete("/posts/{$post->id}")
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_can_delete_posts()
    {
        $this->signIn();
        $post = create('App\Post', ['user_id' => auth()->id()]);

        $this->delete("/posts/{$post->id}")->assertStatus(302);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    /** @test */
    function unauthorized_users_cannot_update_posts()
    {
        $this->withExceptionHandling();

        $post = create('App\Post');

        $this->patch("/posts/{$post->id}")
            ->assertRedirect('login');

        $this->signIn()
            ->patch("/posts/{$post->id}")
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_can_update_posts()
    {
        $this->signIn();

        $post = create('App\Post', ['user_id' => auth()->id()]);

        $updatedPost = 'Comentario modificado fool';

        $this->patch("/posts/{$post->id}", ['comments' => $updatedPost]);

        $this->assertDatabaseHas('posts', ['id' => $post->id, 'comments' => $updatedPost]);
    }
}
