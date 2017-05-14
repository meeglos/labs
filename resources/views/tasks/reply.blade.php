<div class="panel panel-default">
    <div class="panel-heading">
        {{--<h5 class="flex">--}}
            <a href="{{ route('profile', $task->creator) }}">
                {{ $post->owner->name }}
            </a> said {{ $post->created_at->diffForHumans() }}
        {{--</h5>--}}
        <span class="pull-right">
            {!! Form::open(['method' => 'POST', 'action' => array('FavoritesController@store', $post->id)]) !!}  {{-- /posts/{{  $post->id }}/favorites --}}

            {!! Form::submit($post->favorites_count . ' ' . str_plural('favorito', $post->favorites_count), ['class'=> 'btn btn-default btn-xs', $post->isFavorited() ? 'disabled' : 'none']) !!}

            {!! Form::close() !!}
        </span>
    </div>
    <div class="panel-body">
        {{ $post->comments }}
    </div>
</div>