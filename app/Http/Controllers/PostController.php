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
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Task $task)
    {
        $task->addComment([
            'comments'  => request('comments'),
            'user_id'   => auth()->id()
        ]);

        return back();
    }
}
