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
                           
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                Avaliado
                            </h3>
                            <span class="pull-right clickable"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row clearfix">
								<div><!-- Dados do funcionario -->
									<div class="panel-body col-md-8">
											<table class="table table-stripped">
													@if (!$funcionario)
														{{"Pessoa não encontrada"}}
													@else
														@foreach ($funcionario as $p)
															<tr>
																<td colspan ="2" > <h4><b> {{$p->NOME}}</b></h4></td>
															</tr>
															<tr>											
																<td><b>CHAPA:</b>{{$p->CHAPA}} </td>
																<td><b>CARGO:</b> {{$p->CARGO}} </td>
															</tr>
															<tr>											
																<td><b>ADMISSÃO:</b> {{date("d/m/Y", strtotime($p->DATAADMISSAO))}}</td>
																<td><b>DEMISSAO:</b> @IF($p->DATADEMISSAO){{date("d/m/Y", strtotime($p->DATADEMISSAO))}} @else Nada Consta @endif </td>
															</tr>
															<tr>
																<td><b>LOJA:</b> {{$p->LOJA}}</td>
																<td><b>LIDER ATUAL:</b> {{$p->LIDER }}</td>
															</tr>
														@endforeach
													@endif
												</table>
									</div><!-- Dados do funcionario -->
									<div class="col-md-2 panel-body">
										@foreach ($funcionario as $f)
										<!--<img src="/assets/images/avaliacao/avatar.png" width="180px" height="180px"/>-->
										{{  $f->IMAGEM }}
										<img width="150px" height="180px" src="data:image/jpeg;base64,{{ base64_encode( $f->IMAGEM )}}"/> 
										@endforeach
									</div>
								</div>
                              
								<div class="row clearfix">
									<div class="col-md-12">
										
										<div class="dropdown" style="margin-bottom:15px;">
											  <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color: $fff;">
											    Alterar Liderança nas Avaliações de {{$funcionario[0]->NOME}}
											    <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
												    <li><a href="delegaTodas?xyz={{$funcionario[0]->CHAPA}}">Delegar Avaliações ainda não feitas</a></li>
												    <li><a href="mudaequipe?xyz={{$funcionario[0]->CHAPA}}">Mudar Equipe do funcionário</a></li>
												    <li role="separator" class="divider"></li>
												    <li class="text-center">Atenção, pois as duas ações<br/> 
												    não significam o mesmo</li>
											  </ul>
										</div>
											<table class="table table-stripped table-bordered">
												<tr>
													<th>Codigo</th>
													<th>Nome da Avaliação</th>
													<th>Avaliador</th>
													<th>Nome do AValiador</th>
													<th>Já foi feita?</th>
													<th>Delegar</th>
												</tr>
												@foreach ($avaliado as $a)
												<tr>
													<td>{{$a->CODAVALIACAO}}</td>
													<td>{{$a->NOMEAVALIACAO}}</td>
													<td>{{$a->CHAPAAVALIADOR}}</td>
													<td>{{$a->NOMELIDER}}</td>
													<td>@if ($a->TEMAVALIACAO=='S') SIM @else NÃO @endif</td>
													<td>@if ($a->TEMAVALIACAO=='S') <span class="text-info">Aval. já Feita</span> 
														@else 
															@if($a->LICENCA=='S') Férias / Licença
															@else
															<a href="delega?xyz={{$funcionario[0]->CHAPA}}&a={{$a->CODAVALIACAO}}&p={{$a->CODPARTICIPANTE}}" class="btn btn-sm btn-warning" style="color: $fff;">
																<span class="glyphicon glyphicon-wrench"></span> Delegar </a>
															@endif	
														@endif</td>
												</tr>
												@endforeach
											</table>
									</div>
								</div>
                            </div>
                        </div>
                        <!-- / Building Form. --> </div>
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/advfeatures.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
@stop
