@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} publicó una tarea
        <a href="{{ $activity->subject->path() }}">{{ $activity->subject->description }}</a>.
    @endslot

    @slot('body')
        {{ $activity->subject->description }}
    @endslot

@endcomponent