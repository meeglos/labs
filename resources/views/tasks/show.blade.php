@extends('layouts.app')

@section('content')
    <task-view :initial-posts-count="{{ $task->posts_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            @can ('update', $task)
                                <span class="pull-right" style="margin-left: 1em;">
                                    <form action="{{ $task->path() }}" method="post">

                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        {{--<input type="submit" class="btn btn-danger btn-sm">Borrar tarea</input>--}}
                                        {!! Form::submit('Borrar tarea', ['class'=> 'btn btn-danger btn-xs']) !!}

                                    </form>
                                </span>
                            @endcan
                            <a href="{{ route('profile', $task->creator) }}">{{ $task->creator->name }}</a>
                                posted: {{ $task->description }}
                        </div>

                        <div class="panel-body">
                            <span style="margin-right: 15px;">Nombre cliente: {{ $task->client_name }}</span>
                            <span style="margin-right: 15px;">Código cliente: {{ $task->client_code }}</span>
                            <span style="margin-right: 15px;">Teléfono cliente: {{ $task->client_phone }}</span>
                        </div>
                    </div>

                    <posts @added="postsCount++" @removed="postsCount--"></posts>

                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Información de la tarea
                        </div>
                        <div class="panel-body">
                            <p>Esta tarea fue creada {{ $task->created_at->diffForHumans() }}
                                por <a href="#">{{ $task->creator->name }}</a>
                                y actualmente tiene <span v-text="postsCount"></span> {{ str_plural('comentario', $task->posts_count) }}.
                            </p>

                            <p>
                                <subscribe-button :active="{{ json_encode($task->isSubscribedTo) }}"></subscribe-button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </task-view>
@endsection
