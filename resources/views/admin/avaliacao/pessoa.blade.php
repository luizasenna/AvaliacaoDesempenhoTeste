@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Avaliação de Desempenho
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/bootstrap-form-builder/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/formbuilder.css') }}" rel="stylesheet" />
@stop


{{-- Page content --}}
@section('content')
    
    <section class="content-header">
            <!--section starts-->
            <h1>Avaliação de Desempenho</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                        Dashboard
                    </a>
                </li>
                <li class="active"> <a href="{{route('painel')}}">
                Avaliação de Desempenho 2.0</a></li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
    <!-- Aba de Título -->

    
    
    <div class="row" style="min-height:800px;" >
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
							<div class="col-md-3 panel-body">
								@foreach ($funcionario as $f)
								<!--<img src="/assets/images/avaliacao/avatar.png" width="180px" height="180px"/>-->
								
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
														<td></td>
													</tr>
													<tr>
														<td colspan ="2">LIDER ATUAL: {{$p->LIDER}} </td>
													</tr>
													<tr >
														<td> <a style="color:#ffffff;" href="/avaliacao/delegaTodas?c={{$p->CHAPA}}" class="btn btn-danger" title="Delegar as avaliações de funcáionrio para outro lider"><span class="glyphicon glyphicon-random"></span> Delegar as avaliações deste funcionário</a></td>
														<td>  
															<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
															 <span class="glyphicon glyphicon-time"></span> Ver Férias, Afastamentos e Licenças
															</button>
															</td>
													</tr>
												@endforeach
											@endif
										</table>
										<!-- Modal -->
										<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
										   <div class="modal-dialog" role="document">
											    <div class="modal-content">
										  	        <div class="modal-header">
													      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													      <h4 class="modal-title" id="myModalLabel">Férias e Licenças</h4>
												    </div>
												    <div class="modal-body">
 											      	    <table class="table table-stripped">
														 	<tr class="bg-primary">
														 	 	<td>Tipo de Licença</td>
																<td>Data Inicial</td>
																<td>Data Final</td>
													 	 	</tr>
													 	 	@foreach ($licencas as $licenca)
													 	 	<tr>
													 	 		<td>{{$licenca->LICENCA}}</td>
													 	 		<td>{{date("d/m/Y", strtotime($licenca->DTINICIAL))}}</td>
													 	 		<td>{{date("d/m/Y", strtotime($licenca->DTFINAL))}}</td>
													 	 	</tr>
													 	 	@endforeach
												      	</table>
													 </div>
												    <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
												     </div>
												</div>
											</div>
										</div>
					
							</div><!-- Dados do funcionario -->
							
							<!-- Gráfico -->
							<div class="panel-body col-md-3">
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
						<!-- <a data-toggle="collapse" href="#collapse1" >-->
						<i class="livicon icon3 " data-name="list" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Competências Avaliadas para a Função</h3></a>
                    </div>
					<div class="panel-body panel-collapse collapse in" id="collapse1" >
					<!--<div class="panel-body"  >-->
							<table class="table table-stripped">
								
								<tr>
								@foreach ($compfuncao as $c)
									@if ($c->c1 == 0)
									<td id="comp01">01 - Aprendizagem e Adaptação</td>
									@else
									<td id="comp01" style="color:#bbb;">01 - Aprendizagem e Adaptação <span class="text-danger">(inativo) </span></td>
									@endif
									@if ($c->c2 == 0)
									<td id="comp02">02 - Apresentação Pessoal</td>
									@else
									<td id="comp02" style="color:#bbb;">02 - Apresentação Pessoal <span class="text-danger">(inativo) </span></td>
									@endif
									
									<td id="comp03" >03 - Assiduidade </td>
									
									
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
											<td><a data-toggle="modal" data-target="#myModal{{$n->AVALIACAO}}">{{$n->DESCRICAO}} </a>
											
												<div class="modal fade" id="myModal{{$n->AVALIACAO}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">{{$n->DESCRICAO}}</h4>
													  </div>
													  <div class="modal-body">
														<table class="table table-stripped table-bordered info">
															<tr  class="info">
																<th>Avaliação feita por </th>
																<th>Data </th>
																<th>Avaliação TOTVS</th>
																<th>Participante TOTVS</th>
															</tr>
															<tr>
																<td>{{$n->AVALIADOR}}</td>
																<td>{{$n->FEITAEM}}</td>
																<td>{{$n->AVALIACAO}}</td>
																<td>{{$n->PARTICIPANTE}}</td>
															</tr>
														</table>
														<table class="table table-stripped table-bordered">
															
																
															<tr>
																<td  class="info"><b>01 - Aprendizagem e Adaptação</b></td>
																<td class="warning"><b>Nota: @if ($c->c1==0){{$n->NOTA1}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS1}} </td>
															</tr>
															<tr>
																<td  class="info"><b>02 - Apresentação Pessoal</b></td>
																<td class="warning"><b>Nota: @if ($c->c2==0){{$n->NOTA2}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS2}} </td>
															</tr>
															<tr>
																<td class="info"><b>03 - Assiduidade </b></td>
																<td class="warning"><b>Nota: {{$n->NOTA3}}  </b></td>
																
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS3}} </td>
															</tr>
															<tr>
																<td  class="info"><b>04 - Comunicação</b></td>
																<td class="warning"><b>Nota: @if ($c->c4==0){{$n->NOTA4}}  @else - @endif </b></td>
																
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS4}} </td>
															</tr>
															<tr>
																<td  class="info"><b>05 - Disciplina e Respeito</b></td>
																<td class="warning"><b>Nota: @if ($c->c5==0){{$n->NOTA5}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS5}} </td>
															</tr>
															<tr>
																<td  class="info"><b>06 - Estabilidade Emocional</b></td>
																<td class="warning"><b>Nota: @if ($c->c6==0){{$n->NOTA6}}  @else - @endif </b></td>
																
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS6}} </td>
															</tr>
															<tr>
																<td  class="info"><b>07 - Hábitos de Segurança, Higiene e Zelo</b></td>
																<td class="warning"><b>Nota: @if ($c->c7==0){{$n->NOTA7}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS7}} </td>
															</tr>
															<tr>
																<td  class="info"><b>08 - Iniciativa e Criatividade</b></td>
																<td class="warning"><b>Nota: @if ($c->c8==0){{$n->NOTA8}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS8}} </td>
															</tr>
															<tr>
																<td  class="info"><b>09 - Interesse, Dedicação e Sigilo</b></td>
																<td class="warning"><b>Nota: @if ($c->c9==0){{$n->NOTA9}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS9}} </td>
															</tr>
															<tr>
																<td  class="info"><b>10 - Organização</b></td>
																<td class="warning"><b>Nota: @if ($c->c10==0){{$n->NOTA10}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS10}} </td>
															</tr>
															<tr>
																<td  class="info"><b>11 - Pontualidade</b></td>
																<td class="warning"><b>Nota: @if ($c->c11==0){{$n->NOTA11}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS11}} </td>
															</tr>
															<tr>
																<td  class="info"><b>12 - Produtividade</b></td>
																<td class="warning"><b>Nota: @if ($c->c12==0){{$n->NOTA12}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS12}} </td>
															</tr>
															<tr>
																<td  class="info"><b>13 - Qualidade</b></td>
																<td class="warning"><b>Nota: @if ($c->c13==0){{$n->NOTA13}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS13}} </td>
															</tr>
															<tr>
																<td  class="info"><b>14 - Relacionamento Pessoal e Colaboração</b></td>
																<td class="warning"><b>Nota: @if ($c->c14==0){{$n->NOTA14}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS14}} </td>
															</tr>
															<tr>
																<td  class="info"><b>15 - Administração</b></td>
																<td class="warning"><b>Nota: @if ($c->c15==0){{$n->NOTA15}}  @else - @endif </b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Observação da nota: </b> {{$n->OBS15}} </td>
															</tr>
															
														</table>
													  </div>
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
													  </div>
													</div>
												  </div>
												</div>
											
											</td>											
											
												<td>@if ($c->c1==0){{$n->NOTA1}}  @else - @endif</td>
												<td>@if ($c->c2==0){{$n->NOTA2}}  @else - @endif</td>
												<td>{{$n->NOTA3}}</td>
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
												<td> {{round($n->MEDIA,2)}}</td> 
										
										@endforeach
										@endforeach
									  </tr>			
									</table>
									
									@if($licenciados)

										<div class="alert-warning"> <b>Férias / Licenças: </b>
										@foreach ($licenciados as $l) {{$l->NOME}} / @endforeach </div>

									@endif
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

    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/modal/js/classie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/modal/js/modalEffects.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/switchery/js/switchery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/advfeatures.js') }}"></script>
<script>
	

		$("#alert_msg").fadeTo(5800, 1600).slideUp(500, function(){
		$("#alert_msg").slideUp(500);
});
	
	</script>
@stop
