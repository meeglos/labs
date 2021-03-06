<?php

namespace App\Http\Controllers;

use App\Post;
use App\Task;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Task $task)
    {
        return $task->posts()->paginate(5); // temporary set to 1
    }
    /**
     * @param $channelId
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Task $task)
    {
        $this->validate(request(), [
            'comments' => 'required'
        ]);

        $post = $task->addComment([
            'comments'  => request('comments'),
            'user_id'   => auth()->id()
        ]);

        if (request()->expectsJson()) {
            return $post->load('owner');
        }

        return back()->with('flash', 'Tu comentario ha sido guardado.');
    }

    public function update(Post $post)
    {
//        return $post;
        $this->authorize('update', $post);

        $post->update(request(['comments']));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);

        $post->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Comentario eliminado.']);
        }

        return back();
    }
}
