@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ($tasks as $task)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="label label-info pull-right">
                                <a href="{{ $task->path() }}" style="text-decoration: none; color: #c4e3f3">
                                    {{ $task->posts_count }} {{ str_plural('comentario', $task->posts_count) }}
                                </a>
                            </span>
                            <a href="{{ $task->path() }}">
                                {{ $task->description }}
                            </a>
                        </div>
                        <div class="panel-body">
                            <div class="body">El nombre del cliente es {{ $task->client_name }} y su teléfono {{ $task->client_phone }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
