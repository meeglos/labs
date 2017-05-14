<?php

namespace App;

use App\Filters\TaskFilters;
use Illuminate\Database\Eloquent\Model;
use Styde\Html\Str;

class Task extends Model
{
    protected $guarded = [];

    protected $with = ['creator'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('postCount', function ($builder) {
              $builder->withCount('posts');
        });
    }

    public function path()
    {
        return "/tasks/{$this->channel->slug}/{$this->id}";
    }

    public function posts()
    {
        return $this->hasMany(Post::class)
            ->withCount('favorites')
            ->with('owner');
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

    /**
     * @param $query
     * @param TaskFilters $filters
     * @return mixed
     */
    public function scopeFilter($query, TaskFilters $filters)
    {
        return $filters->apply($query);
    }
}
