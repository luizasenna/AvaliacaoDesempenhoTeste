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
    
    
    <div class="container" style="min-height:800px;" >
        <!--Content Section Start -->
		<div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="list" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Perfil</h3>
                    </div>
						<div class="panel-body">
							<!-- Foto -->
							<div class="col-md-2 panel-body pull-left">
								<img src="/assets/images/avaliacao/avatar.png" width="180px" height="180px"/>
							</div>
							<!-- Foto -->
							
							<!-- Dados do funcionario -->
							<div class="panel-body col-md-6">
									<table class="table table-stripped ">
										    @if (!$funcionario)
												{{"Pessoa não encontrada"}}
											@else
						    
												@foreach ($funcionario as $p)
													<tr>
														<td colspan ="2" >NOME: {{$p->NOME}}</td>
													</tr>
													<tr>											
														<td>CHAPA: {{$p->CHAPA}} </td>
														<td>CARGO: {{$p->CARGO}} </td>
													</tr>
													<tr>											
														<td>ADMISSÃO: {{date("d/m/Y", strtotime($p->DATAADMISSAO))}}</td>
														<td>NASCIMENTO: </td>
													</tr>
													<tr>
														<td colspan ="2">LIDER ATUAL: {{$lider[0]->NOME}} </td>
													</tr>
												@endforeach
											@endif
										</table>
					
							</div><!-- Dados do funcionario -->
							
							<!-- Gráfico -->
							<div class="panel-body col-md-4">
									<img src="/assets/images/avaliacao/grafico.png" width="350px" height="180px"/>
							</div> <!-- Gráfico -->
							
						</div>
				</div>
				</div>		

				<div class="container" style="min-height:800px;" >
				<div class="col-md-12">
					 <div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">
							<i class="livicon icon3" data-name="list" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
							Avaliações</h3>
						</div>
						
							<!-- Dados da avaliação -->
							<div class="panel-body col-md-12">
									<table class="table table-stripped table-bordered ">
										<tr class="primary" style="color:#fff;">
											<td>NOME DA AVALIAÇÃO </td>											
											<td><abbr title="Aprendizagem e Adaptação" class="initialism">01</abbr> </td>
											<td><abbr title="Apresentação Pessoal" class="initialism">02</abbr> </td>
											<td><abbr title="Assiduidade" class="initialism">03</abbr> </td>
											<td><abbr title="Comunicação" class="initialism">04</abbr> </td>
											<td><abbr title="Disciplina e Respeito" class="initialism">05</abbr> </td>
											<td><abbr title="Estabilidade Emocional" class="initialism">06</abbr> </td>
											<td><abbr title="Hábitos de Segurança, Higiene e Zelo" class="initialism">07</abbr> </td>
											<td><abbr title="Iniciativa e Criatividade" class="initialism">08</abbr> </td>
											<td><abbr title="Interesse, Dedicação e Sigilo" class="initialism">09</abbr> </td>
											<td><abbr title="Organização" class="initialism">10</abbr> </td>
											<td><abbr title="Pontualidade" class="initialism">11</abbr> </td>
											<td><abbr title="Produtividade" class="initialism">12</abbr> </td>
											<td><abbr title="Qualidade" class="initialism">13</abbr> </td>
											<td><abbr title="Relacionamento Pessoal e Colaboração" class="initialism">14</abbr> </td>
											<td><abbr title="Administração" class="initialism">15</abbr> </td>
											<td>MÉDIA TOTAL </td>
										</tr>
										@foreach ($resultado as $n)
										<tr> 
											<td>{{$n->DESCRICAO}} </td>											
											<td>{{$n->NOTA01}}</td>
											<td>{{$n->NOTA02}} </td>
											<td>{{$n->NOTA03}} </td>
											<td>{{$n->NOTA04}} </td>
											<td>{{$n->NOTA05}} </td>
											<td>{{$n->NOTA06}} </td>
											<td>{{$n->NOTA07}} </td>
											<td>{{$n->NOTA08}} </td>
											<td>{{$n->NOTA09}} </td>
											<td>{{$n->NOTA10}} </td>
											<td>{{$n->NOTA11}} </td>
											<td>{{$n->NOTA12}} </td>
											<td>{{$n->NOTA13}} </td>
											<td>{{$n->NOTA14}} </td>
											<td>{{$n->NOTA15}} </td>
											<td>{{$n->MEDIA}} </td>
										@endforeach
									  </tr>			
									</table>
							</div><!-- Dados da avaliação -->
						
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
