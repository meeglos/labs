@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>
                {{ $profileUser->name }}
                <small> Registrado desde {{ $profileUser->created_at->diffForHumans() }}</small>
            </h3>
        </div>

        @foreach($tasks as $task)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="label label-info pull-right" style="padding: 5px 10px; margin-left: 1em;">
                        {{ $task->created_at->diffForHumans() }}
                    </span>
                    <span class="label label-info pull-right" style="padding: 5px 10px; margin-left: 1em;">
                        {{ $task->created_at->diffForHumans() }}
                    </span>
                    <a href="#">{{ $task->creator->name }}</a> posted:
                    {{ $task->description }}

                </div>
                <div class="panel-body">
                    {{ $task->client_name }}
                </div>
            </div>
        @endforeach

        {{ $tasks->links() }}
    </div>
@endsection