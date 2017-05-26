<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskSubscriptionsController extends Controller
{
    public function store($channelId, Task $task)
    {
        $task->subscribe();
    }

    public function destroy($channelId, Task $task)
    {
        $task->unsubscribe();
    }
}
