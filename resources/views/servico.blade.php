@extends('layouts/default')

{{-- Page title --}}
@section('title')
Atualização Cadastral
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
    <div class="container">
        <!--Content Section Start -->
        <h2 class="welcome">Solicitação de Serviços</h2>
        <div class="row">
		<div class="col-md-6" style="border: 1px solid #000;">
		<div  class="tabbable-panel bs-example">
		 <div class="tabbable-line">	
			 <div nav nav-tabs>
			  <form action="novoservico">
				 <fieldset>
					 <legend>Nova Solicitação</legend>	 
						<div class="form-group ui-draggable-handle" style="position: static;">
							<label for="solicitante">Solicitante:</label>
							<input type="text" class="form-control" id="idsolicitante" placeholder="solicitante">
						</div>
						<div class="form-group ui-draggable-handle" style="position: static;">
							<label for="funcionario">Funcionário</label>
							<select class="form-control" id="idfuncionario">
									<option value="1">Option 1</option>
									<option value="2">Option 2</option>
									<option value="3">Option 3</option>
							</select>
							<p class="help-block">Escolha acima o funcionário que precisa do serviço.</p>
						</div>
						<div class="form-group ui-draggable-handle" style="position: static;">
							<label for="loja">Loja</label>
							<select class="form-control" id="loja">
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
							<input type="text" class="form-control" id="funcao" placeholder="Insira o cargo do funcionário">
						</div>
						<div class="form-group ui-draggable-handle" style="position: static;">
							<label for="select-3">Sexo</label>
							<select class="form-control" id="sexo">
									<option value="F">Feminino</option>
									<option value="M">Masculino</option>
							</select>
						</div>
						<div class="form-group ui-draggable-handle" style="position: static;">
							<label for="select-4">Setor do RH Responsável</label>
							<select class="form-control" id="setorrh">
									<option value="0">Setor Pessoal</option>
									<option value="1">Controle de Jornada de Trabalho</option>
									<option value="2">Recrutamento, Seleção e Treinamento</option>
							</select>
						</div>
					</fieldset>
					<fieldset>
						<legend>Solicitação</legend>
						<!-- Multiple Radios -->
						<div class="checkbox control-group">
						   <div class="controls">
							<label class="radio" for="solicitacao">
							  <input type="radio" name="solicitacao" id="solicitacao" value="2ª Via Contra-Cheque" checked="checked">
							  2ª Via Contra-Cheque
							</label>
							<label class="radio" for="solicitacao">
							  <input type="radio" name="solicitacao" id="solicitacao" value="2ª Via Cartão Vale Refeição">
							  2ª Via Cartão Vale Refeição
							</label>
							<label class="radio" for="solicitacao">
							  <input type="radio" name="solicitacao" id="solicitacao" value="2ª Via Cartão Vale Transporte">
							  2ª Via Cartão Vale Transporte
							</label>
							<label class="radio" for="solicitacao">
							  <input type="radio" name="solicitacao" id="solicitacao" value="2ª Via Cartão UNIMED">
							  2ª Via Cartão UNIMED
							</label>
							<label class="radio" for="servicos-4">
							  <input type="radio" name="solicitacao" id="solicitacao" value="2ª Via Cartão UNIODONTO">
							  2ª Via Cartão UNIODONTO
							</label>
							<label class="radio" for="servicos-5">
							  <input type="radio" name="solicitacao" id="solicitacao" value="Crachá">
							  Crachá
							</label>
							<label class="radio" for="servicos-6">
							  <input type="radio" name="solicitacao" id="solicitacao" value="Fardamento">
							  Fardamento
							</label>
							<label class="radio" for="servicos-7">
							  <input type="radio" name="solicitacao" id="solicitacao" value="Declaração de Trabalho/Horário">
							  Declaração de Trabalho/Horário
							</label>
							<label class="radio" for="servicos-8">
							  <input type="radio" name="solicitacao" id="solicitacao" value="Outro">
							  Outro:  <input type="text" name="solicitacao" id="solicitacao" value="">
							</label>
						  </div>
						</div>
						<!-- Multiple Radios -->
						<div class="form-group ui-draggable-handle" style="position: static;">
							<label for="motivo">Motivo da Solicitação:</label>
							<input type="text-area" class="form-control" id="motivo" placeholder="">
						</div>
					</fieldset>

					<fieldset>
					<legend>Exclusivo para Fardamento</legend>
						<div class="form-group ui-draggable-handle" style="position: static;">
							<label for="camisa">Camisa / Blusa</label>
							<select class="form-control" id="camisa">
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
							<select class="form-control" id="camisa">
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
							<select class="form-control" id="calcado">
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
					<div class="control-group">
					  <div class="controls">
						<button class="btn btn-danger" type="submit">Enviar</button>
					  </div>
					</div>  
		</form>

    </div>
	</div>
</div>
</div></div>
        
        
        
        <!-- //Content Section End -->
		</div>
	</div>	
    
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
