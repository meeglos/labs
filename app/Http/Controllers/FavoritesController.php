<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Post;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Post $post
     */
    public function store(Post $post)
    {
        $post->favorite();
    }
}
