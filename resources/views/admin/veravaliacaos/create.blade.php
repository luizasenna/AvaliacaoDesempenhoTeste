@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Criar nova Visualização de Avaliação 
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Veravaliacaos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Visualização de Avaliações criadas no totvs</li>
        <li class="active">Adicionar Nova Visualização de Avaliação</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Adicionar nova Visualização de Avaliação
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

                    {!! Form::open(['url' => 'admin/veravaliacaos']) !!}

                    <div class="form-group">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {!! Form::label('id', 'Id: (deixe em branco para criar automaticamente) ') !!}
                        {!! Form::text('id', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('codigoavaliacao', 'Codigo da avaliacao no RM: ') !!}
                        {!! Form::text('codigoavaliacao', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('statuslider', 'Status para o lider: ') !!}
                        {!! Form::text('statuslider', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('statusadmin', 'Status para o admin: ') !!}
                        {!! Form::text('statusadmin', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('statusdiretoria', 'Status para a diretoria: ') !!}
                        {!! Form::text('statusdiretoria', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('obs', 'Observações: ') !!}
                        {!! Form::textarea('obs', null, ['class' => 'form-control']) !!}
                    </div>

					

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.veravaliacaos.index') }}">
                                @lang('button.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
                                @lang('button.save')
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>

@stop
