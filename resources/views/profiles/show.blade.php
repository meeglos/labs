@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>
                {{ $profileUser->name }}
                <small> Registrado desde {{ $profileUser->created_at->diffForHumans() }}</small>
            </h3>
        </div>

        @foreach($activities as $date => $activity)
            <h3 class="page-header">{{ $date }}</h3>

            @foreach ($activity as $record)
                @include ("profiles.activities.{$record->type}", ['activity' => $record])
            @endforeach
        @endforeach
    </div>
@endsection