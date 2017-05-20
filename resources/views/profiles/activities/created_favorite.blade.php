@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} marcó <a href="{{ $activity->subject->favorited->path() }}"> este post</a>  como favorito..
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->comments }}
    @endslot

@endcomponent