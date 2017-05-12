@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Tasks</div>

                    <div class="panel-body">
                        @foreach ($tasks as $task)
                            <article>
                                <a href="{{ $task->path() }}">
                                    <span class="label label-info pull-right" style="padding: 5px 10px; margin-left: 1em;">{{ $task->posts_count }} {{ str_plural('comentario', $task->posts_count) }}</span>
                                </a>
                                <h4>
                                    <a href="{{ $task->path() }}">
                                        {{ $task->description }}
                                    </a>
                                </h4>
                                <div class="body">El nombre del cliente es {{ $task->client_name }} y su teléfono {{ $task->client_phone }}</div>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
