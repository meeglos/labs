@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><a href="{{ route('profile', $task->creator) }}">{{ $task->creator->name }}</a> posted:
                        {{ $task->description }}</h4>
                    </div>

                    <div class="panel-body">
                        <span style="margin-right: 15px;">Nombre cliente: {{ $task->client_name }}</span>
                        <span style="margin-right: 15px;">Código cliente: {{ $task->client_code }}</span>
                        <span style="margin-right: 15px;">Teléfono cliente: {{ $task->client_phone }}</span>
                    </div>
                </div>

                @foreach ($posts as $post)
                    @include ('tasks.reply')
                @endforeach

                {{ $posts->links() }}

                @if (auth()->check())

                    {{--{!! Form::open(['method' => 'POST', 'route' => array('PostController@store', $task->id)]) !!}--}}
                    {{--{!! Form::open(['method' => 'POST', 'route' => $task->path().'/posts']) !!}--}}
                    <form method="POST" action="{{ $task->path() . '/posts' }}">
                    {{ csrf_field() }}
                        {!! Field::textarea('comments', ['label' => 'Comentario', 'rows' => '3', 'placeholder' => 'Escriba su comentario']) !!}

                        {!! Form::submit('Guardar', ['class'=> 'btn btn-primary form-control']) !!}

                    {!! Form::close() !!}

                @else
                    <p class="text-center">Por favor <a href="{{ route('login') }}">regístrese</a> para poder comentar.</p>
                @endif
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Información de la tarea
                    </div>
                    <div class="panel-body">
                        <p>Esta tarea fue creada {{ $task->created_at->diffForHumans() }} por <a href="#">{{ $task->creator->name }}</a> y actualmente tiene {{ $task->posts_count }} {{ str_plural('comentario', $task->posts_count) }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
