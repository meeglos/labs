<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Favoritable;

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
