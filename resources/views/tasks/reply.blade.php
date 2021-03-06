<reply :attributes="{{ $post }}" inline-template v-cloak>
    <div id="post-{{ $post->id }}" class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('profile', $task->creator) }}">
                {{ $post->owner->name }}
            </a> said {{ $post->created_at->diffForHumans() }}

            @if (Auth::check())
                <span class="pull-right">
                    <favorite :post="{{ $post }}"></favorite>
                </span>
            @endif

            {{--@can ('update', $post)--}}
                <span class="pull-right">
                    <button class="btn btn-warning btn-xs btn-ml-5" @click="editing = true">Editar</button>
                </span>

                <span class="pull-right">
                    <button class="btn btn-danger btn-xs" @click="destroy">Borrar</button>
                </span>
            {{--@endcan--}}
        </div>
        <div class="panel-body">
            <div v-if="editing">
                {!! Field::textarea('comments', ['label' => 'Comentario', 'v-model' => 'comments', 'rows' => '2', 'placeholder' => 'Escriba su comentario']) !!}
                {!! Form::button('Actualizar', ['class' => 'btn btn-xs btn-info', '@click' => 'update']) !!}
                {!! Form::button('Cancelar', ['class' => 'btn btn-xs btn-link', '@click' => 'editing = false']) !!}
            </div>

            <div v-else v-text="comments">
                {{ $post->comments }}
            </div>
        </div>
    </div>
</reply>