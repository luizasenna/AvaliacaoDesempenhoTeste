@extends('layouts/default')

{{-- Page title --}}
@section('title')
Agenda de Contatos
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
 <!--page level css starts-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/panel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/features.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/switchery/css/switchery.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}">
    <!--end of page level css-->
@stop
{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Home
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="#">Agenda de Contatos</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="home" data-size="20" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i> Agenda de Contatos
            </div>
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')
    <!-- Aba de Título -->
    <div class="text-center">
                <h3 class="border-warning"><span class="heading_border bg-warning"> 
				<i class="livicon icon3" data-name="home" data-size="30" data-loop="true" data-c="#ffffff" data-hc="red"></i>
				Agenda de Contatos</span></h3>
        </div>	<center>
        <div class="col-md-4 pull-center">
			@if (session('status'))
		<div id="alert_msg" class="alert alert-info alert-dismissable">
			<strong>{{ session('status') }}</strong>
		</div>
		@endif
	</div></center>
    
    
    <div class="container" style="min-height:800px;">
        <!--Content Section Start -->
		<div class="col-md-12">
			
			<div class="col-md-2"></div>
			<div class="col-md-8 well rounded" style="padding: 10px;">
				<div >
				<h3>Inserir Nova Pessoa: </h3>
					<form action="/agenda/addPessoa" method="post">
						{!! csrf_field() !!}
						<div class="row">
						    <div class="col-md-12">
						        <div class="form-group ui-draggable-handle">
						            <label for="input-text-1">
						                Nome</label>
						            <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome completo">
						        </div>
						        <div class="form-group ui-draggable-handle" >
						            <label for="input-text-2">
						                Apelido</label>
						            <input type="text" class="form-control" id="apelido" name="apelido" placeholder="insira um apelido">
						            <p class="help-block">Insira um apelido que ajude na busca, como o nome reduzido.</p>
						        </div>
						        <div class="form-group ui-draggable-handle" >
						            <label for="select-1">
						                Tipo de Pessoa</label>
						            <select class="form-control" id="idtipo" name="idtipo">
						            @foreach ($tipoPessoas as $t)
						            	<option value="{{$t->id}}">{{$t->nome}}</option>
						            @endforeach
						            </select>
						        </div>
						        <div class="form-group ui-draggable-handle" >
						            <label for="select-2">
						                Empresa</label>
						            <select class="form-control" id="empresa" name="idempresa">
						             <option>Nenhuma</option>	
						             <option value="1">Pintos</option>
						             <option>---------</option>
						             @foreach ($empresas as $e)
						            	<option value="{{$e->id}}">{{$e->nome}}</option>
						             @endforeach	

						            </select>
						        </div>
						        <div class="form-group ui-draggable-handle">
						            <label for="input-text-3">
						                Código de Pessoa TOTVS </label>
						            <input type="text" class="form-control" id="idpessoatotvs" name="idpessoatotvs" placeholder="Insira o código TOTVS">
						            <p class="help-block">Caso a pessoa seja funcionária da Pintos.</p>
						        </div>
						        <div class="form-group ui-draggable-handle">
						            <label for="input-text-4">
						                Chapa TOTVS</label>
						            <input type="text" class="form-control" id="chapatotvs" name="chapatotvs" placeholder="Insira a chapa do funcionário">
						            <p class="help-block">Caso a pessoa seja funcionária da Pintos.</p>
						        </div>
						    </div>
						</div>
						<button type="submit" class="btn btn-default pull-right">Salvar</button>
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/advfeatures.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
@stop
