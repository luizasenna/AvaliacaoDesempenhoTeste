@extends('layouts/default')

{{-- Page title --}}
@section('title')
Avaliação de Desempenho dos Funcionários
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
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="#">Avaliação de Desempenho</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="barchart" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Avaliação de Desempenho
            </div>
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')
    <!-- Aba de Título -->
    <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary"> 
				<i class="livicon icon3" data-name="barchart" data-size="30" data-loop="true" data-c="#ffffff" data-hc="red"></i>
				Avaliação de Desempenho</span></h3>
        </div>	<center>
        <div class="col-md-4 pull-center">
			@if (session('status'))
		<div id="alert_msg" class="alert alert-info alert-dismissable">
			<strong>{{ session('status') }}</strong>
		</div>
		@endif
	</div></center>
   
    <div class="container" >
        <!--Content Section Start -->
		<div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                     
						<h3>Avaliação <<Nome>></h3> 
                        @foreach ($avaliado as $a)	
                            <tr>
                                <td>
                                     <div id="placeholdernolegend" class="demo-placeholder1"></div> 
                                
                                </td>
                           </tr>
        					<tr>
								<td> <i class="livicon icon3" data-name="list-ul" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						         Avaliação de {{$a->funcionario ? $a->funcionario->NOME : '--' }}</td>
								<td>  - Chapa: {{$a->CHAPAAVALIADO }} </td>
								<td> - Avaliador: {{$a->CHAPAAVALIADOR }} </td>
							</tr>
						
						@endforeach</h3>
                    
                    </div>
                    <div class="panel-body">
						 <!--  Consulta de Solicitações --> 
						 <table class="table table-striped ..."> 
			
						 </table>
                        <table class="table table-striped ...">
							<tr>
								<td colspan="4" align="middle"class="primary"><h4 style="color:#fff;">Notas</h4></td>
							</tr>
                            <tr>
                            	<td> ITEM </td>
                                <td> COMPETÊNCIA</td>
								<td> NOTAAVALIADOR  </td>
							</tr>
							@foreach ($notas as $n)	
							<tr>
   								<td> {{$n->ITEM }}</td>
                                <td> {{$n->NOME }}</td>
								<td> {{$n->NOTA }} </td>
							</tr>
							@endforeach
						</table>
						
					</div>
				</div>
				</div>		
        <!-- //Content Section End -->
		
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.pie.js') }}" ></script>
@stop
