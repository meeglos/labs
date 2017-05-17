@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>
                {{ $profileUser->name }}
                <small> Registrado desde {{ $profileUser->created_at->diffForHumans() }}</small>
            </h3>
        </div>

        @foreach($activities as $activity)
            @include ("profiles.activities.{$activity->type}")
        @endforeach
    </div>
@endsection