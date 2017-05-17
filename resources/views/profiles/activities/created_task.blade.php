<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            {{ $profileUser->name }} publicó una tarea
            <a href="{{ $activity->subject->path() }}">{{ $activity->subject->description }}</a>.
        </span>
    </div>
    <div class="panel-body">
        {{ $activity->subject->description }}
    </div>
</div>
