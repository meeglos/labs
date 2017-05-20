<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Favoritable, RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'favorites', 'task'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function path()
    {
        return $this->task->path() . "#post-{$this->id}";
    }
}
