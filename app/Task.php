<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Styde\Html\Str;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'channel_id',
        'agent_code',
        'client_code',
        'client_name',
        'client_phone',
        'slug',
        'description',
    ];

    public function path()
    {
        return "/tasks/{$this->channel->slug}/{$this->id}";
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addComment($post)
    {
        $this->posts()->create($post);
    }
}
