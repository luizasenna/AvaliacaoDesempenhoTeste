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
        <div class="col-md-12 pull-center">
		<div class="col-md-4 pull-center"></div>
			@if (session('status'))
		<center><div id="alert_msg" class="col-md-4 alert alert-info alert-dismissable pull-center">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{ session('status') }}</strong>
		</div></center><div class="col-md-4 pull-center"></div>
		@endif 
	</div></center>
   
    <div class="container" >
        <!--Content Section Start -->
		<div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="list-ul" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Dados da Avaliação</h3>
                    </div>
  
                    <div class="panel-body">
						 <!--  Consulta de Solicitações --> 
						 <table class="table table-striped ..."> 
								
						@foreach ($avaliacao as $a)
								<tr>
								   <td>
								   <h5><b> Nome: {{$a->NOME}} </b></h5></td>
								   <td><h5><b>Abertura: {{date("d/m/Y", strtotime($a->DATAABERTURA))}}</b></h5></td>

								</tr>
						@endforeach
						 </table>
                        <table class="table table-striped ...">
							<tr>
								<td colspan="4" align="middle"class="primary"><h4 style="color:#fff;">Avaliações Pendentes</h4></td>
							</tr>
							 @if (!$faltantes)
							<tr>
								<td colspan="4" align="middle">Parabéns! Você avaliou toda sua equipe nesta etapa.</td>
							</tr>
						    @else
							<tr class="primary" style="color:#ffffff;">
								<td>Avaliado</td>
								<td>Chapa</td>
								<td>Avaliador</td>
								<td>Avaliador</td>
							</tr>
							@endif
						@foreach ($faltantes as $e)	
							<tr>
								<td> {{$e->NOME }}</td>
								<td> {{$e->CHAPAAVALIADO }} </td>
								<td> {{$e->CHAPAAVALIADOR }} </td>
								<td><a style="color:#ffffff;" href="/avaliacao/insere?id={{$e->CODAVALIACAO}}&pt={{$e->CODPARTICIPANTE}}&c={{$e->CHAPAAVALIADO }}" class="btn btn-sm btn-warning" title="Avaliar Funcionário para este mês"><span class="glyphicon glyphicon-zoom-in"></span> Avaliar Agora</a>
								<a style="color:#ffffff;" href="/avaliacao/delegaUma?id={{$e->CODAVALIACAO}}&pt={{$e->CODPARTICIPANTE}}&c={{$e->CHAPAAVALIADO }}" class="btn btn-sm btn-danger" title="Delegar este mês para outro lider"><span class="glyphicon glyphicon-random"></span> </a></td>
							</tr>
						
						@endforeach
						</table>
						<table class="table table-striped ...">
							<tr>
								<td colspan="4" align="middle" class="primary"><h4 style="color:#fff;">Já Avaliados</h4></td>
							</tr>
							
							 @if (!$feitos)
							<tr>
								<td colspan="4" align="middle">Nenhuma avaliação feita ainda.</td>
							</tr>
							@else
							<tr class="primary" style="color:#ffffff;">
								<td>Avaliado</td>
								<td>Chapa</td>
								<td>Avaliador</td>
								<td>Visualizar</td>
							</tr>
							@endif
						@foreach ($feitos as $f)	
							<tr>
								<td> {{$f->NOME }}</td>
								<td> {{$f->CHAPA }} </td>
								<td> {{$f->CHAPAAVALIADOR }} </td>
								<td><a style="color:#ffffff;" href="/avaliacao/painel?id={{$f->CHAPA}}" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> Ver Funcionário</a></td>
								
							</tr>
						
						@endforeach
						</table>
					<!--	@if ($invalidos)
						   <table class="table table-striped ...">
							<tr>
								<td colspan="4" align="middle" class="default"><h4>Funcionário Inválido</h4></td>
							</tr>
						    <tr> <td colspan="3">Caso haja algum avaliado aqui embaixo, avise a equipe do RH para verificar se há algum problema de configuração em sua equipe. </td></tr>
							
							@endif
						@foreach ($invalidos as $i)	
							<tr>
								<td> {{$i->NOME }}</td>
								<td> {{$i->CHAPA }} </td>
								<td> Avaliação Não Disponível</td> 
								
							</tr>
						
						@endforeach-->
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

@stop
