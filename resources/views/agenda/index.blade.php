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
        </div>
        <div class="col-md-4 "></div>
        <div class="col-md-4">
			@if (session('status'))
			<div id="alert_msg" class="alert alert-info alert-dismissable text-center">
				<strong>{{ session('status') }}</strong>
			</div>
		@endif
		<div class="col-md-4"></div>
	</div></center>
    
    
    <div class="container" style="min-height:800px;">
        <!--Content Section Start -->
		<div class="col-md-12">
			
			<div class="col-md-2"></div>
			<div class="col-md-8 bg-warning rounded" style="padding: 10px;">
				<div >
				<h3>Buscar Pessoa: </h3>
					<form action="/agenda/busca" method="post">
						<div class="form-group">
						    <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira um nome">
						</div>
						{!! csrf_field() !!}
						<button type="submit" class="btn btn-default pull-right">Buscar</button>
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="col-md-12" style="padding-top: 10px;">
			<div class="col-md-8"></div>
			<div class="col-md-3">
				<a class="btn btn-lg btn-primary"  style="color: #fff;" href="/agenda/insere/" role="button">Inserir novo cadastro</a>
			</div>
			<div class="col-md-1"></div>
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
