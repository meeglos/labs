@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>
                {{ $profileUser->name }}
                <small><span class="glyphicon glyphicon-sunglasses"></span> Registrado desde {{ $profileUser->created_at->diffForHumans() }}</small>
            </h3>
        </div>

        @forelse($activities as $date => $activity)
            <h3 class="page-header">{{ $date }}</h3>

            @foreach ($activity as $record)
                @if (view()->exists("profiles.activities.{$record->type}"))
                    @include ("profiles.activities.{$record->type}", ['activity' => $record])
                @endif
            @endforeach
        @empty
            <div class="well well-sm">Este usuario aún no tiene actividad registrada.</div>
        @endforelse
    </div>
@endsection