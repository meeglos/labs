@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <a href="#">{{ $task->creator->name }}</a> posted:
                        {{ $task->description }}
                    </div>

                    <div class="panel-body">
                        <span style="margin-right: 15px;">Nombre cliente: {{ $task->client_name }}</span>
                        <span style="margin-right: 15px;">Código cliente: {{ $task->client_code }}</span>
                        <span style="margin-right: 15px;">Teléfono cliente: {{ $task->client_phone }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ($task->posts as $post)
                    @include ('tasks.reply')
                @endforeach
            </div>
        </div>

        @if (auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    {{--{!! Form::open(['method' => 'POST', 'route' => array('PostController@store', $task->id)]) !!}--}}
                    {{--{!! Form::open(['method' => 'POST', 'route' => $task->path().'/posts']) !!}--}}
                    <form method="POST" action="{{ $task->path() . '/posts' }}">
                    {{ csrf_field() }}
                        {!! Field::textarea('comments', ['label' => 'Comentario', 'rows' => '3', 'placeholder' => 'Escriba su comentario']) !!}

                        {!! Form::submit('Guardar', ['class'=> 'btn btn-primary form-control']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <p class="text-center">Por favor <a href="{{ route('login') }}">regístrese</a> para poder comentar.</p>
        @endif
    </div>
@endsection
