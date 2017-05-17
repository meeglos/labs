<?php

namespace App;

use App\Filters\TaskFilters;
use Illuminate\Database\Eloquent\Model;
use Styde\Html\Str;
use Tests\Unit\ActivityTest;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('postCount', function ($builder) {
              $builder->withCount('posts');
        });

        static::deleting(function ($task) {
           $task->posts->each->delete();
        });
    }

    public function path()
    {
        return "/tasks/{$this->channel->slug}/{$this->id}";
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
//            ->withCount('favorites')
//            ->with('owner');
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
