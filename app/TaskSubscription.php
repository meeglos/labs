<?php

namespace App;

use App\Notifications\TaskWasUpdated;
use Illuminate\Database\Eloquent\Model;

class TaskSubscription extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function notify($post)
    {
        $this->user->notify(new TaskWasUpdated($this->task, $post));
    }
}
