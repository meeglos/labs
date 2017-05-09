<div class="panel panel-default">
    <div class="panel-heading">
        <a href="#">
            {{ $post->owner->name }}
        </a> said {{ $post->created_at->diffForHumans() }}
    </div>
    <div class="panel-body">
        {{ $post->comments }}
    </div>
</div>