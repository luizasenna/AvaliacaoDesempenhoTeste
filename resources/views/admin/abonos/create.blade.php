@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New abono
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Abonos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Abonos</li>
        <li class="active">Adicionar Novo Abono</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Adicionar Novo Abono a ser Considerado na Assiduidade
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

                    {!! Form::open(['url' => 'admin/abonos']) !!}

                    <div class="form-group">
                        {!! Form::label('string', 'Código no RM: ') !!}
                        {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('string', 'Descricao: ') !!}
                        {!! Form::text('descricao', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('string', 'Status: (0 - Ativo e 1 - Inativo) ') !!}
                        {!! Form::text('status', null, ['class' => 'form-control']) !!}

                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.abonos.index') }}">
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
