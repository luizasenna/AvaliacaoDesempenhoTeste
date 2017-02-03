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
                    <a href="{{ route('avaliacao') }}">Avaliação de Desempenho</a>
                </li>
				<li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="#">Painel de Avaliação de {{ $funcionario[0]->NOME}}</a>
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
        
    @if ($perm == '0' )
		<div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="list" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Perfil</h3>
                    </div>
						<div class="panel-body">
							<!-- Foto -->
							@foreach ($resultado as $res)
							{{ $res->MEDIA}}
							@endforeach
							
							<div class="col-md-2 panel-body">
								@foreach ($funcionario as $f)
								<!--<img src="/assets/images/avaliacao/avatar.png" width="180px" height="180px"/>-->
								{{  $f->IMAGEM }}
								<img width="150px" height="180px" src="data:image/jpeg;base64,{{ base64_encode( $f->IMAGEM )}}"/> 
								@endforeach
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
									<!--<img src="/assets/images/avaliacao/grafico.png" width="350px" height="180px"/>-->
							</div> <!-- Gráfico -->
							
						</div>
				</div>
				</div>		

		 <!-- Competências -->
		<div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<a data-toggle="collapse" href="#collapse1">
						<i class="livicon icon3 " data-name="list" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Competências Avaliadas para o Cargo</h3></a>
                    </div>
					<div class="panel-body panel-collapse collapse" id="collapse1" >
							<table class="table table-stripped">
								
								<tr>
								@foreach ($compfuncao as $c)
									@if ($c->c1 == 0)
									<td id="comp01" class="text-info">01 - Aprendizagem e Adaptação</td>
									@else
									<td id="comp01" style="color:#bbb;">01 - Aprendizagem e Adaptação <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c2 == 0)
									<td id="comp02">02 - Apresentação Pessoal</td>
									@else
									<td id="comp02" style="color:#bbb;">02 - Apresentação Pessoal <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c3 == 0)
									<td id="comp03" >03 - Assiduidade </td>
									@else
									<td id="comp03" style="color:#bbb;">03 - Assiduidade <span class="text-danger">(inativo) </span></td>
									@endif
								</tr>
								<tr>
									
									@if ($c->c4 == 0)
									<td id="comp04" >04 - Comunicação </td>
									@else
									<td id="comp04" style="color:#bbb;">04 - Comunicação <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c5 == 0)
									<td id="comp05" >05 - Disciplina e Respeito </td>
									@else
									<td id="comp05" style="color:#bbb;">05 - Disciplina e Respeito <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c6 == 0)
									<td id="comp06" >06 - Estabilidade Emocional </td>
									@else
									<td id="comp06" style="color:#bbb;">06 - Estabilidade Emocional <span class="text-danger">(inativo) </span></td>
									@endif
								</tr>
								<tr>
									
									@if ($c->c7 == 0)
									<td id="comp07" >07 - Hábitos de Segurança, Higiene e Zelo</td>
									@else
									<td id="comp07" style="color:#bbb;">07 - Hábitos de Segurança, Higiene e Zelo <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c8 == 0)
									<td id="comp08" >08 - Iniciativa e Criatividade</td>
									@else
									<td id="comp08" style="color:#bbb;">08 - Iniciativa e Criatividade <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c9 == 0)
									<td id="comp09" >09 - Interesse, Dedicação e Sigilo</td>
									@else
									<td id="comp09" style="color:#bbb;">09 - Interesse, Dedicação e Sigilo <span class="text-danger">(inativo) </span></td>
									@endif
								</tr>
								<tr>
									@if ($c->c10 == 0)
									<td id="comp10" >10 - Organização</td>
									@else
									<td id="comp10" style="color:#bbb;">10 - Organização <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c11 == 0)
									<td id="comp11" >11 - Pontualidade</td>
									@else
									<td id="comp11" style="color:#bbb;">11 - Pontualidade <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c12 == 0)
									<td id="comp12" >12 - Produtividade</td>
									@else
									<td id="comp12" style="color:#bbb;">12 - Produtividade <span class="text-danger">(inativo) </span></td>
									@endif
								</tr>
								<tr>
									@if ($c->c13 == 0)
									<td id="comp13" >13 - Qualidade</td>
									@else
									<td id="comp13" style="color:#bbb;">13 - Qualidade <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c14 == 0)
									<td id="comp14" >14 - Relacionamento Pessoal e Colaboração</td>
									@else
									<td id="comp14" style="color:#bbb;">14 - Relacionamento Pessoal e Colaboração <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c15 == 0)
									<td id="comp15" >15 - Administração</td>
									@else
									<td id="comp15" style="color:#bbb;">15 - Administração <span class="text-danger">(inativo) </span></td>
									@endif
								</tr>	@endforeach																													
							</table>	
							
							
					
							
					</div>
				</div>
		</div>		
		<!-- Competências -->
					
		 <!-- Avaliações -->
		<div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="list" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Notas</h3>
                    </div>
					<div class="panel-body">
							<!-- Dados da avaliação -->
							<div class="panel-body col-md-12">
								
									<table class="table table-stripped table-bordered ">
									@if ($resultado)	
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
									@else Nenhuma Nota ainda cadastrada para este funcionário. Começe a fazer avaliações <a class="info" href="http://rh.pintos.com.br/avaliacao">na Área de Avaliações Abertas</a>. 
									@endif
									
										
										@foreach ($compfuncao as $c)
										@foreach ($resultado as $n)
										<tr> 
											<td>{{$n->DESCRICAO}} </td>											
											<td>@if ($c->c1==0) {{$n->NOTA1}} @else - @endif</td>
											<td>@if ($c->c2==0){{$n->NOTA2}}  @else - @endif</td>
											<td>@if ($c->c3==0){{$n->NOTA3}} @else - @endif</td>
											<td>@if ($c->c4==0){{$n->NOTA4}} @else - @endif</td>
											<td>@if ($c->c5==0){{$n->NOTA5}} @else - @endif</td>
											<td>@if ($c->c6==0){{$n->NOTA6}} @else - @endif</td>
											<td>@if ($c->c7==0){{$n->NOTA7}} @else - @endif</td>
											<td>@if ($c->c8==0){{$n->NOTA8}} @else - @endif</td>
											<td>@if ($c->c9==0){{$n->NOTA9}} @else - @endif</td>
											<td>@if ($c->c10==0){{$n->NOTA10}} @else - @endif</td>
											<td>@if ($c->c11==0){{$n->NOTA11}} @else - @endif</td>
											<td>@if ($c->c12==0){{$n->NOTA12}} @else - @endif</td>
											<td>@if ($c->c13==0){{$n->NOTA13}} @else - @endif</td>
											<td>@if ($c->c14==0){{$n->NOTA14}} @else - @endif</td>
											<td>@if ($c->c15==0){{$n->NOTA15}} @else - @endif</td>
											<td>{{ $n->MEDIA }} </span></td>
										@endforeach
										@endforeach
									  </tr>			
									</table>
							</div><!-- Dados da avaliação -->
							
							
					
							
					</div>
				</div>
		</div>		
		<!-- Avaliações -->
			

        <!-- //Content Section End -->
	</div>
	@else 
	<div class="container">
		<div class="row">
			<div class="alert alert-danger">
				{{ $perm }}
			</div>
			<a href="http://rh.pintos.com.br/avaliacao" class="btn btn-default" role="button">Voltar</a>
		</div>
	</div>
	@endif
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
