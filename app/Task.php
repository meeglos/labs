<?php

namespace App;

use App\Filters\TaskFilters;
use App\Notifications\TaskWasUpdated;
use Illuminate\Database\Eloquent\Model;
use Styde\Html\Str;
use Tests\Unit\ActivityTest;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected $appends = ['isSubscribedTo'];

    protected static function boot()
    {
        parent::boot();

/* not used anymore since we added a posts_count field to the table */
//        static::addGlobalScope('postCount', function ($builder) {
//              $builder->withCount('posts');
//        });

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
        $post = $this->posts()->create($post);

        $this->subscriptions
            ->where('user_id', '!=', $post->user_id)
            ->each->notify($post);

        return $post;
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

    /**
     * @param int|null $userId
     * @return $this
     */
    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    public function subscriptions()
    {
        return $this->hasMany(TaskSubscription::class);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }
}
