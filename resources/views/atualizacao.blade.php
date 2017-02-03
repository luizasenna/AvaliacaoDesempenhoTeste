@extends('layouts/default')

{{-- Page title --}}
@section('title')
Atualização Cadastral
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
 <!--page level css starts-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/panel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/features.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/switchery/css/switchery.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" />
    <link href="{{ asset('assets/css/pages/alertmessage.css') }}" rel="stylesheet"  type="text/css"/>
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
                    <a href="#">Atualização Cadastral</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Atualização Cadastral
            </div>
        </div>
    </div>

    
    @stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
        <div class="row" style="background-color:#eee;">
		
		 <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary">Atualização Cadastral</span></h3>
         </div>	<center>
         <div class="col-md-4 pull-center">
			@if (session('status'))
			<div id="alert_msg" class="alert alert-info alert-dismissable">
				<strong>{{ session('status') }}</strong>
			</div>
			@endif
			</div></center>
         <div class="col-md-12" style="margin:12px;padding-right:48px;">
			

          	  <!--  Acorddions--> 
                       <div class="panel-group" id="accordion">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"  style="color:#fff;" >
                                                    <span class=" glyphicon glyphicon-plus"></span>
                                                    <span>Nova Solicitação de Atualização</span></a>
                                                </h4>
                                        </div>
                                        
                            
                                          <div id="collapseOne" class="panel-collapse collapse ">
											<div class="col-md-12" style="background-color:#fff;">  
											<div class="col-md-6 pull-left" style="margin-top:20px;">
													 <!--  Formulario --> 
	
														<div class="col-md-6">
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="input-text-1">
																	Solicitante</label>
																    	<input disabled type="text" class="form-control" value="{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}" placeholder="solicitante">
																		<input type="hidden" class="form-control" id="idsolicitante" value="{{ Sentinel::getUser()->id }}" name="idsolicitante" />
																		<input type="hidden" class="form-control" id="status" value="0" name="status" />
															</div>
															<div class="form-group ui-draggable-handle">
																<label for="funcionario">
																	Funcionario</label>
																<select class="form-control" id="funcionario" name="funcionario">
																	    <option value="1">Luiza</option>
																		<option value="2">Patrícia</option>
																		<option value="3">Ivaney</option>
																</select>
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="funcao">
																	Função</label>
																<select class="form-control" id="funcao" name="funcao">
																		<option value="1">Vendedor</option>
																		<option value="2">Supervisor</option>
																		<option value="3">Assistente</option>
																</select>
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="email">
																	Email</label>
																<input type="email" class="form-control" id="email"" name="email" placeholder="Insira o email do Funcionário">
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="telefone">
																	Telefone</label>
																<input type="email" class="form-control" id="input-text-3" placeholder="Telefone do Funcionário">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="tiposanguineo">
																	Tipo Sanguíneo</label>
																<input type="text" class="form-control" id="tiposanguineo" name="tiposanguineo" placeholder="Tipo Sanguíneo do Funcionário">
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="tipo">
																	Tipo de Atualização Desejada</label>
																<select class="form-control" id="tipoatualizacao" name="tipoatualizacao">
																		<option value="1">Dependentes (certidão de nascimento, cartão de vacina até 07 anos ou declaração escolar até 14 anos)</option>
																		<option value="2">Endereço (talão água/energia ou correspondência com carimbo dos correios)</option>
																		<option value="3">Estado Civil (certidão de casamento, divórcio ou certidão de óbito do cônjuge)</option>
																		<option value="4">Grau de Instrução (certificado da Instituição de Ensino)</option>
																		<option value="5">E-mail</option>
																		<option value="6">Telefone</option>
																		<option value="7">Telefone</option>
																		<option value="8">Tipo Sanguíneo</option>
																		<option value="9">Vários Dados / Outros</option>
																</select>
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="arquivoatualizacao">
																	Upload de documentos comprovatórios</label>
																<input type="file" id="arquivoatualizacao" name="arquivoatualizacao">
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="observacoes">
																	Observações</label>
																<input type="memo" class="form-control" id="observacoes" name="observacoes" placeholder="Insira observações sobre esta atualização para a equipe do rh">
															</div>
														</div>
															
													 <!--  Formulario --> 
													 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Acorddions--> 
    
            
         </div>
		<div class="col-md-12">

				<div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Solicitações Abertas</h3>
                    </div>
                    <div class="panel-body">
						 <!--  Consulta de Solicitações --> 
                         @if (!$todos)
							{{"Você ainda não fez nenhuma solicitação"}}
						 @else
							<table class="table table-striped ...">
								<tr class="text-primary">
									<td><b>Data do Pedido</b></td>
									<td><b>Funcionário</b></td>
									<td><b>Solicitação</b></td>
									<td><b>Status</b></td>
									<td><b>Recebida por</b></td>
									<td><b>Última Atualização</b></td>
									<td><b>Observações</b></td>
								</tr>
								@foreach ($todos as $p)
							    <!-- código escondido -->
								<tr>
								   <td> {{@date('d-m-Y H:m',strtotime($p->created_at))}}</td>
								   <td> {{$p->idfuncionario}}</td>
								   <td> {{$p->solicitacao}} - 
									   @if ($p->solicitacao == '0') {{'Setor Pessoal'}} @endif
								       @if ($p->solicitacao == '1') {{'Controle de Jornada de Trabalho'}} @endif
								       @if ($p->solicitacao == '2') {{'Recrutamento, Seleção e Treinamento'}} @endif
								   </td>    
								   <td> {{$p->status}} - 
									    @if ($p->status == '0') {{'Aberta'}} @endif
									    @if ($p->status == '1') {{'Em andamento'}} @endif
									    @if ($p->status == '2') {{'Finalizada'}} @endif
								   </td>
								   <td> {{$p->idusuario}}</td>
								   <td> {{@date('d-m-Y H:m',strtotime($p->updated_at))}}</td> 
								   <td> {{$p->observacoes}}</td>
								</tr>
								@endforeach
								@endif
								
							</table>
						<!--  Consulta de Solicitações--> 
						
					</div>
				</div>
				</div>		

			
		</div>
		</div>
   </div>
    <!-- Container Section End -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')



@stop
