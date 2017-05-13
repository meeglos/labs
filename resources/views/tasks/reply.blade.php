<div class="panel panel-default">
    <div class="panel-heading">
        {{--<h5 class="flex">--}}
            <a href="#">
                {{ $post->owner->name }}
            </a> said {{ $post->created_at->diffForHumans() }}
        {{--</h5>--}}
        <span class="pull-right">
            {!! Form::open(['method' => 'POST', 'action' => array('FavoritesController@store', $post->id)]) !!}  {{-- /posts/{{  $post->id }}/favorites --}}

            {!! Form::submit($post->favorites()->count() . ' ' . str_plural('favorito', $post->favorites()->count()), ['class'=> 'btn btn-default btn-xs', $post->isFavorited() ? 'disabled' : 'none']) !!}

            {!! Form::close() !!}
        </span>
    </div>
    <div class="panel-body">
        {{ $post->comments }}
    </div>
</div>