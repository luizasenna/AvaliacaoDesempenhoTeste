@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Editar uma visualização de Avaliação
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Veravaliacaos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Visualização de Avaliações de Desempenho</li>
        <li class="active">Criar nova visualização</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Editar 
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($veravaliacao, ['method' => 'PATCH', 'action' => ['VeravaliacaosController@update', $veravaliacao->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('id', 'Id: ') !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('codigoavaliacao', 'Codigo da avaliação: ') !!}
                        {!! Form::text('codigoavaliacao', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('statuslider', 'Status do lider: ') !!}
                        {!! Form::text('statuslider', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('statusadmin', 'Status do admin: ') !!}
                        {!! Form::text('statusadmin', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('statusdiretoria', 'Status da diretoria: ') !!}
                        {!! Form::text('statusdiretoria', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('obs', 'Obs: ') !!}
                        {!! Form::textarea('obs', null, ['class' => 'form-control']) !!}
                    </div>

					

                    <div class="form-group">
                        {!! Form::submit('Atualizar', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</section>
@stop
