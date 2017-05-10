@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear nueva tarea</div>

                    <div class="panel-body">

                        {!! Form::open(array('method' => 'POST', 'action' => 'TaskController@store')) !!}

                        <div class="row col-md-12">
                            <div class="col-md-6">
                                {!! Field::text('agent_code', old('agent_code'), ['label' => 'Código agente', 'placeholder' => 'Código del agente', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{--{!! Field::select('channel_id', $channels, ['label' => 'Canal', 'placeholder' => 'Código del agente']) !!}--}}
                            {!! Field::select('channel_id', $channels,  old('channel_id'), ['empty' => 'Elija un canal', 'id' => 'channel_id', 'label' => 'Canal', 'required']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::text('client_code',  old('client_code'), ['label' => 'Código cliente', 'placeholder' => 'Código del agente', 'required']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::text('client_name', old('client_name'),  ['label' => 'Nombre cliente', 'placeholder' => 'Código del agente', 'required']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::text('client_phone', old('client_phone'),  ['label' => 'Teléfono', 'placeholder' => 'Teléfono del cliente', 'required']) !!}
                        </div>
                        <div class="col-md-12">
                            {!! Field::textarea('description', old('description'),  ['label' => 'Tarea', 'rows' => '3', 'placeholder' => 'Escriba el detalle', 'required']) !!}
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class'=> 'btn btn-primary form-control']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
