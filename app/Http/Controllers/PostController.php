<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
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

        $task->addComment([
            'comments'  => request('comments'),
            'user_id'   => auth()->id()
        ]);

        return back();
    }
}
