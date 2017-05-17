<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            {{ $profileUser->name }} registró un comentario en
            <a href="{{ $activity->subject->task->path() }}">"{{ $activity->subject->task->description }}"</a>.
        </span>
    </div>
    <div class="panel-body">
        {{ $activity->subject->comments }}
    </div>
</div>