@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Editar uma Competência por Cargo
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Vercargos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Painel
            </a>
        </li>
        <li>Competências por Cargos</li>
        <li class="active">Cargos</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Editar Competências por Cargos
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

                    {!! Form::model($vercargo, ['method' => 'PATCH', 'action' => ['VercargosController@update', $vercargo->id]]) !!}

                    
					<div class="form-group">
                        {!! Form::label('nome', 'Nome: ') !!}
                        {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c1', '01 - Aprendizagem e Adaptação: ') !!}
                        {!! Form::text('c1', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c2', '02 - Apresentação Pessoal: ') !!}
                        {!! Form::text('c2', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c3', '03 - Assiduidade: ') !!}
                        {!! Form::text('c3', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c4', '04 - Comunicação: ') !!}
                        {!! Form::text('c4', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c5', '05 - Disciplina e Respeito: ') !!}
                        {!! Form::text('c5', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c6', '06 - Estabilidade Emocional: ') !!}
                        {!! Form::text('c6', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c7', '07 - Hábitos de Segurança, Higiene e Zelo: ') !!}
                        {!! Form::text('c7', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c8', '08 - Iniciativa e Criatividade: ') !!}
                        {!! Form::text('c8', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c9', '09 - Interesse, Dedicação e Sigilo: ') !!}
                        {!! Form::text('c9', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c10', '10 - Organização: ') !!}
                        {!! Form::text('c10', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c11', '11 - Pontualidade: ') !!}
                        {!! Form::text('c11', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c12', '12 - Produtividade: ') !!}
                        {!! Form::text('c12', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c13', '13 - Qualidade: ') !!}
                        {!! Form::text('c13', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c14', '14 - Relacionamento Pessoal e Colaboração: ') !!}
                        {!! Form::text('c14', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c15', '15 - Administração: ') !!}
                        {!! Form::text('c15', null, ['class' => 'form-control']) !!}
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
