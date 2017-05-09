@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create new task</div>

                    <div class="panel-body">

                        {!! Form::open(array('method' => 'POST', 'action' => 'TaskController@store')) !!}

                        <div class="col-md-6">
                            {!! Field::text('agent_code', ['label' => 'Código agente', 'placeholder' => 'Código del agente']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::text('client_code', ['label' => 'Código cliente', 'placeholder' => 'Código del agente']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::text('client_name', ['label' => 'Nombre cliente', 'placeholder' => 'Código del agente']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::text('client_phone', ['label' => 'Teléfono', 'placeholder' => 'Teléfono del cliente']) !!}
                        </div>
                        <div class="col-md-12">
                            {!! Field::textarea('description', ['label' => 'Tarea', 'rows' => '3', 'placeholder' => 'Escriba el detalle']) !!}
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
