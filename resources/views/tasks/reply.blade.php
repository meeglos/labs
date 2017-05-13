<div class="panel panel-default">
    <div class="panel-heading">
        {{--<h5 class="flex">--}}
            <a href="#">
                {{ $post->owner->name }}
            </a> said {{ $post->created_at->diffForHumans() }}
        {{--</h5>--}}
        <span class="pull-right">
            {!! Form::open() !!}

            {!! Form::submit('Favorito', ['class'=> 'btn btn-default btn-xs']) !!}

            {!! Form::close() !!}
        </span>
    </div>
    <div class="panel-body">
        {{ $post->comments }}
    </div>
</div>