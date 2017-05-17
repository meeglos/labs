@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} registró un comentario en
        <a href="{{ $activity->subject->task->path() }}">"{{ $activity->subject->task->description }}"</a>.
    @endslot

    @slot('body')
        {{ $activity->subject->comments }}
    @endslot

@endcomponent