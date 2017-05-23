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
			
				<h3>Você deseja inserir: </h3>
				<div class="bg-warning col-md-3" style="padding:10px;">
					<h4>Nova entidade</h4> 
					<hr class="dotted">
					<a class="btn btn-default btn-lg"  href="/agenda/inserePessoa/" role="button">Nova pessoa</a> <br>
					<a class="btn btn-default btn-lg"  href="/agenda/insereEmpresa/" role="button">Nova empresa</a>
				</div>
				<div class="bg-warning col-md-3" style="padding:10px;">
					<h4>Telefone de cadastro existente</h4> 
					<hr class="dotted">
					<a class="btn btn-lg btn-default"  href="/agenda/insere/" role="button">Telefone de uma pessoa</a>
					<a class="btn btn-lg btn-default"  href="/agenda/insere/" role="button">Telefone de uma empresa</a>
				</div>
				<div class="bg-warning col-md-3" style="padding:10px;">
					<h4>Endereço de cadastro existente</h4> 
					<hr class="dotted">
					<a class="btn btn-lg btn-default"  href="/agenda/insere/" role="button">Endereço de uma pessoa</a>
					<a class="btn btn-lg btn-default"  href="/agenda/insere/" role="button">Endereço de uma empresa</a>
				</div>
				<div class="bg-warning col-md-3" style="padding:10px;">
					<h4>Email de cadastro existente</h4> 
					<hr class="dotted">
					<a class="btn btn-lg btn-default"  href="/agenda/insere/" role="button">Email de uma pessoa</a>
					<a class="btn btn-lg btn-default"  href="/agenda/insere/" role="button">Email de uma empresa</a>
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
