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
