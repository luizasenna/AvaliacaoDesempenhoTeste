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
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i>
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
					
                <div class="panel panel-primary" >
                    <div class="panel-heading" role="tab">
                    	<a data-toggle="collapse" data-parent="#accordion" data-target="#equipe" style="color: #fff;" aria-controls="equipe" >
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="users" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Equipe</h3> <span> (clique para abrir ou fechar)</span></a>
						 
                    </div>
                    <div id="equipe" class="panel-collapse collapse" role="tabpanel" >
                    <div class="panel-body" >
						 <!--  Consulta de Solicitações --> 
						 <table class="table table-striped ...">
						 	@foreach ($lider as $l)
							    <!-- código escondido -->
								<tr>
								   <td><h5><b>LIDER:  {{$l->NOME}} </b></h5></td>
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
		<div class="panel panel-primary">
                    <div class="panel-heading" role="tab">
                        <a data-toggle="collapse" data-parent="#accordion" data-target="#abertas" style="color: #fff;" aria-controls="abertas" >
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="signal" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Avaliações Abertas</h3> <span> (clique para abrir ou fechar)</span>
						</a>
                    </div>
                    <div id="abertas" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">
						 <!--  Consulta de Avaliação --> 
						  Aqui: @foreach ($passagem as $pp) {{$pp->CODAVALIACAO}} @endforeach
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
							    @if($a->valor > 0)
								<tr> 
								   <td> {{$a->NOME}}</td>
								   <td> {{date("d/m/Y", strtotime($a->DATAABERTURA))}}</td>
								   <td> prazo</td>
								   <td><a style="color:#ffffff;" href="/avaliacao/mostra?id={{$a->CODAVALIACAO}}" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-zoom-in"></span> Avaliar</a></td>
								</tr>
								@endif
								@endforeach
								@endif
							</table>
						 	 <!--  Consulta de Avaliação --> 
					</div>
					</div>
		</div>
		</div>
		<div class="col-md-12">
		<div class="panel panel-primary">
					<div class="panel-heading" role="tab">
						<a data-toggle="collapse" data-parent="#accordion" data-target="#fechadas" style="color: #fff;" aria-controls="fechadas" >
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="signal" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Avaliações Concluidas que Você Participou</h3><span> (clique para abrir ou fechar)</span>
                    </div> </a>
                    <div id="fechadas" class="collapse">
                    <div class="panel-body">
						 <!--  Consulta de Avaliação --> 
						  
							<table class="table table-striped ...">
								<tr  class="primary">
									<td>NOME</td>
									<td>ABERTURA</td>
									<td>AÇÕES</td>
								</tr>
								@foreach ($abertas as $a)
							    @if($a->valor == 0)
								<tr> 
								   <td> {{$a->NOME}}</td>
								   <td> {{date("d/m/Y", strtotime($a->DATAABERTURA))}}</td>
								   
								   <td><a style="color:#ffffff;" href="/avaliacao/mostra?id={{$a->CODAVALIACAO}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-zoom-in"></span> Ver todos os funcionários desta avaliação</a></td>
								</tr> 
								@endif
								@endforeach
							</table>
						 	 <!--  Consulta de Avaliação --> 
					</div>
					</div>
		</div>
		</div>
		<!-- Painel de delegações -->
		<div class="col-md-12">
		<div class="panel panel-primary">
                    <div class="panel-heading" role="tab">
                    	<a data-toggle="collapse" data-target="#delegacoes" style="color: #fff;" aria-controls="delegacoes" >
                        <h3 class="panel-title">
						<i class="glyphicon glyphicon-retweet" data-name="signal" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Situação / Delegação da sua Equipe</h3><span> (clique para abrir ou fechar)</span> </a>
                    </div>
		<div id="delegacoes" class="collapse">
			  <div class="panel-body">
						 <!--  Consulta de Avaliação --> 
						  @if (!$todos)
							{{"Você ainda não é líder de nenhuma equipe"}}
						 @else
						    <h3>Pessoas da sua equipe</h3>
							<table class="table table-striped ...">
								<tr class="primary">
									<td>Nome</td>
									<td>Chapa</td>
									<td>Loja Atual</td>
									<td>Código TOTVS</td>
									<td>Demissão</td>
									<td>Ver / Editar</td>
								</tr>
								@foreach ($delegacao as $e)
								<tr>
								   <td> {{$e->NOME}}</td>
								   <td> {{$e->CHAPA}}</td>
								   <td> {{$e->CODFILIAL}}</td>
								   <td> {{$e->CODPESSOA}}</td>
								   <td> @if($e->DATADEMISSAO == null)  Ativo @else  {{date("d/m/Y", strtotime($e->DATADEMISSAO))}}@endif</td>
								   <td> <a style="color:#ffffff;" href="/avaliacao/avaliado?id={{$e->CHAPA}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-zoom-in"></span> Ver situação</a></td>
								</tr>
								@endforeach
								@endif
							</table>
						 	 <!--  Consulta de Avaliação --> 
				</div>
		</div>
		</div>
		</div>

		<!-- Painel de delegações -->
	@endif <!--checando cadastro do lider -->
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/advfeatures.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
@stop
