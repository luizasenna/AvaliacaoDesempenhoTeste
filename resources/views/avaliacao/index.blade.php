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
    
    
    <div class="container" style="min-height:800px;">
        <!--Content Section Start -->
		<div class="col-md-12">
			
				@if ($erro) <!--checando cadastro do lider -->
					<div>
						<h3>Opa! foi identificado um erro que te impede de proseguir. Abaixo detalhes: </h3> <br/>
						<div class="bg-danger"><p style="padding:20px;"> {{ $erro }} </p></div>
					</div>
				@else
					
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="users" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Equipe</h3>
                    </div>
                    <div class="panel-body">
						 <!--  Consulta de Solicitações --> 
						 <table class="table table-striped ...">
					  
						 @foreach ($lider as $l)
							    <!-- código escondido -->
								<tr>
								   <td>
								   <h5><b>LIDER:  {{$l->NOME}} </b></h5></td>
								   <td><h5><b>FUNÇÃO:  {{$l->funcao ? $l->funcao->NOME : '--' }}</b></h5></td>
								</tr>
								@endforeach
						 </table>
                         @if (!$todos)
							{{"Você ainda não é líder de nenhuma equipe"}}
						 @else
						    
							<table class="table table-striped ...">
								<tr  class="primary">
									<td>NOME</td>
									<td>CHAPA</td>
									<td>FUNÇÃO</td>
									<td>ADMISSAO</td>
									<td>VISUALIZAR</td>
								</tr>
								@foreach ($todos as $p)
							    <!-- código escondido -->
								<tr>
								   <td> {{$p->NOME}}</td>
								   <td> {{$p->CHAPA}}</td>
								   <td> {{$p->CARGO}}</td>
								   <td> {{date("d/m/Y", strtotime($p->DATAADMISSAO))}}</td>
								   <td><a style="color:#ffffff;" href="/avaliacao/painel?id={{$p->CHAPA}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-zoom-in"></span> Desempenho</a></td>
								</tr>
								@endforeach
								@endif
								
							</table>
						<!--  Consulta de Solicitações--> 
						
					</div>
				</div>
				</div>		
				
        <!-- //Content Section End -->
		
		<div class="col-md-12">
		<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="signal" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Avaliações Abertas</h3>
                    </div>
                    <div class="panel-body">
						 <!--  Consulta de Avaliação --> 
						  @if (!$abertas)
							{{"No momento não há avaliações abertas para você."}}
						 @else
						    
							<table class="table table-striped ...">
								<tr  class="primary">
									<td>MÊS</td>
									<td>ABERTURA</td>
									<td>PRAZO</td>
									<td>AVALIAR EQUIPE</td>
								</tr>
								@foreach ($abertas as $a)
							    <!-- código escondido -->
								<tr> 
								   <td> {{$a->NOME}}</td>
								   <td> {{date("d/m/Y", strtotime($a->DATAABERTURA))}}</td>
								   <td> prazo</td>
								   <td><a style="color:#ffffff;" href="/avaliacao/mostra?id={{$a->CODAVALIACAO}}" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-zoom-in"></span> Avaliar</a></td>
								</tr> 
								@endforeach
								@endif
								
							</table>
						 	 <!--  Consulta de Avaliação --> 
						
					</div>
		</div>
				
		</div>
	
		<div class="col-md-12">
		<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="signal" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Avaliações Encerradas que você participou</h3>
                    </div>
                    <div class="panel-body">
						 <!--  Consulta de Avaliação --> 
						  @if (!$fechadas)
							{{"No momento não há avaliações fechadas para você."}}
						 @else
						    
							<table class="table table-striped ...">
								<tr  class="primary">
									<td>NOME</td>
									<td>ABERTURA</td>
									<td>ENCERRAMENTO</td>

								</tr>
								@foreach ($fechadas as $f)
							    <!-- código escondido -->
								<tr>
								   <td> {{$f->NOME}}</td>
								   <td> {{date("d/m/Y", strtotime($f->DATAABERTURA))}}</td>
								   <td> {{date("d/m/Y", strtotime($f->DATAFECHAMENTO))}}</td>
								  
								</tr>
								@endforeach
								@endif
								
							</table>
						 	 <!--  Consulta de Avaliação --> 
						
					</div>
		</div>
		</div>
	@endif <!--checando cadastro do lider -->
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
