<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @return \Illuminate\Http\Response
     * @internal param null $channelSlug
     */
    public function index(Channel $channel)
    {
        if ($channel->exists) {
            $tasks = $channel->tasks()->latest();
        } else {
            $tasks = Task::latest();
        }

        if ($username = request('by')) {
            $user = User::where('name', $username)->firstOrFail();

            $tasks->where('user_id', $user->id);
        }
        $tasks = $tasks->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'agent_code' => 'required',
            'client_code' => 'required',
            'client_name' => 'required',
            'client_phone' => 'required',
            'description' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $task = Task::create([
            'user_id'        => auth()->id(),
            'channel_id'     => request('channel_id'),
            'agent_code'     => request('agent_code'),
            'client_code'    => request('client_code'),
            'client_name'    => request('client_name'),
            'client_phone'   => request('client_phone'),
            'description'    => request('description')
        ]);

        return redirect($task->path());
    }

    /**
     * Display the specified resource.
     *
     * @param $channelId
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
