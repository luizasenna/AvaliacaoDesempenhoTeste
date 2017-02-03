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
                    <a href="#">Solicitação de Serviços</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Solicitação de Serviços
            </div>
        </div>
    </div>

    
    @stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
        <div class="row" style="background-color:#eee;">
		
		 <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary">Solicitação de Serviços ao RH</span></h3>
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
                                                    <span>Nova Solicitação</span></a>
                                                </h4>
                                        </div>
                                        
                            
                                          <div id="collapseOne" class="panel-collapse collapse ">
											<div class="col-md-12" style="background-color:#fff;">  
											<div class="col-md-6 pull-left" style="margin-top:20px;">
													 <!--  Formulario --> 
															<form action="adicionaservico" method="get">
																<fieldset>
																	<legend>Solicitante</legend>
																		<div class="form-group ui-draggable-handle" style="position: static;">
																				<label for="idsolicitante">Solicitante:</label>
																	
																				<input disabled type="text" class="form-control" value="{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}" placeholder="solicitante">
																				<input type="hidden" class="form-control" id="idsolicitante" value="{{ Sentinel::getUser()->id }}" name="idsolicitante" />
																				<input type="hidden" class="form-control" id="status" value="0" name="status" />
																		</div>
																		<div class="form-group ui-draggable-handle" style="position: static;">
																				<label for="idfuncionario">Funcionário:</label>
																				<select class="form-control" id="idfuncionario" name="idfuncionario">
																						<option value="1">Option 1</option>
																						<option value="2">Option 2</option>
																						<option value="3">Option 3</option>
																				</select>
																				<p class="help-block">Escolha acima o funcionário que precisa do serviço.</p>
																		</div>
																		<div class="form-group ui-draggable-handle" style="position: static;">
																				<label for="loja">Loja</label>
																				<select class="form-control" id="loja" name="loja">
																						<option value="1">1 - Magazine</option>
																						<option value="3">3 - Riverside</option>
																						<option value="5">5 - Rio Branco</option>
																						<option value="6">6 - Valter Alencar</option>
																						<option value="8">8 - Calçados</option>
																						<option value="9">9 - Frei Serafim</option>
																						<option value="10">10 - CD2</option>
																						<option value="11">11 - Shopping</option>
																						<option value="12">12 - Rio Poty</option>
																				</select>
																		</div>
																		<div class="form-group ui-draggable-handle" style="position: static;">
																				<label for="funcao">Função do Funcionário</label>
																				<input type="text" class="form-control" id="funcao" name="funcao" placeholder="Insira o cargo do funcionário">
																		</div>
																		<div class="form-group ui-draggable-handle" style="position: static;">
																				<label for="select-3">Sexo</label>
																				<select class="form-control" id="sexo" name="sexo">
																						<option value="F">Feminino</option>
																						<option value="M">Masculino</option>
																				</select>
																		</div>
																		<div class="form-group ui-draggable-handle" style="position: static;">
																				<label for="setorrh">Setor do RH Responsável</label>
																				<select class="form-control" id="setorrh" name="setorrh">
																						<option value="0">Setor Pessoal</option>
																						<option value="1">Controle de Jornada de Trabalho</option>
																						<option value="2">Recrutamento, Seleção e Treinamento</option>
																				</select>
																		</div>
																</fieldset>
											</div>
											<div class="col-md-6 pull-right" style="margin-top:20px;">
														<fieldset>
							 							   <legend>Solicitação</legend>
														  	<div class="form-group ui-draggable-handle" style="position: static;">
																	<label for="setorrh">Serviço Desejado</label>
																	<select class="form-control" id="solicitacao" name="solicitacao">
																			<option value="0">2ª Via Contra-Cheque</option>
																			<option value="1">2ª Via Cartão Vale Refeição</option>
																			<option value="2">2ª Via Cartão Vale Transporte</option>
																			<option value="3">2ª Via Cartão UNIMED</option>
																			<option value="4">2ª Via Cartão UNIODONTO</option>
																			<option value="5">Crachá</option>
																			<option value="6">Fardamento</option>
																			<option value="7">Declaração de Trabalho/HorárioO</option>
																			<option value="8">Outro</option>
																	</select>
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="outra">Outro:</label>
																<input  type="text-area" class="form-control" id="outra" name="outra" placeholder="" />
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="motivo">Motivo da Solicitação:</label>
																<input type="text-area" class="form-control" id="motivo" name="motivo" placeholder="">
															</div>
															<h4 class="text-primary">Exclusivo para Fardamento</h4>
															<div class="form-group ui-draggable-handle" style="position: static;">
																<label for="camisa">Camisa / Blusa</label>
																<select class="form-control" id="camisa" name="camisa">
																	    <option value="0">0</option>
																		<option value="M">PP</option>
																		<option value="P">P</option>
																		<option value="M">M</option>
																		<option value="G">G</option>
																		<option value="P">GG</option>
																		<option value="G">EG</option>
																</select>
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																		<label for="calca">Calça</label>
																		<select class="form-control" id="camisa" name="calca">
																			    <option value="0">0</option>
																				<option value="36">36</option>
																				<option value="38">38</option>
																				<option value="40">40</option>
																				<option value="42">42</option>
																				<option value="44">44</option>
																				<option value="46">46</option>
																				<option value="48">48</option>
																				<option value="50">50</option>
																				<option value="52">52</option>
																				<option value="54">54</option>
																				<option value="P">P</option>
																				<option value="M">M</option>
																				<option value="G">G</option>
																				<option value="P">GG</option>
																				<option value="G">EG</option>
																		</select>
															</div>
															<div class="form-group ui-draggable-handle" style="position: static;">
																		<label for="calcado">Calçado</label>
																		<select class="form-control" id="calcado" name="calcado">
																				<option value="0">0</option>
																				<option value="34">34</option>
																				<option value="35">35</option>
																				<option value="36">36</option>
																				<option value="37">37</option>
																				<option value="38">38</option>
																				<option value="39">39</option>
																				<option value="40">40</option>
																				<option value="41">41</option>
																				<option value="42">42</option>
																				<option value="43">43</option>
																				<option value="44">44</option>
																				<option value="45">45</option>
																				<option value="46">46</option>
																		</select>
																	</div>					
													</fieldset>
											
											</div>
											  
																							
																				
													
													<input type="submit" class="btn btn-danger" value="Enviar" style="margin:10px;"/>
													
                                                </form>
                                                </div>
                                                <!--  Formulario --> 
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
