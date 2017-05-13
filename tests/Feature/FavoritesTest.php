<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;
    /** @test  */
    function guests_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('posts/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_post()
    {
        $this->signIn();

        $post = create('App\Post');

        $this->post('posts/' . $post->id . '/favorites');

        $this->assertCount(1, $post->favorites);
    }

    /** @test */
    function
}
