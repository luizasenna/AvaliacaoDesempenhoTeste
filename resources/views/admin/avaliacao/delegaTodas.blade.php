@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Delegação de Avaliado - AD
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/bootstrap-form-builder/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/formbuilder.css') }}" rel="stylesheet" />
    <script type="stylesheet">
		.center-block {  
			display: block;  
			margin-right: auto;  
			margin-left: auto;  
		} 
	</script>
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
            <!--section starts-->
            <h1>Delegação de Avaliação de Desempenho</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                        Dashboard
                    </a>
                </li>
                <li class="active">Delegando Avaliação</li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <!--main content-->
         
            
            
            <div class="row">
                <div class="col-md-12">
                           
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                Delegar Avaliação
                            </h3>
                            <span class="pull-right clickable"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row clearfix">
								<div>
									<div class="col-md-12 panel-body">
										
										<h4>Delegando Avaliações de<span class="text-info"> @foreach ($funcionario as $f){{$f->NOME}}@endforeach</span></h4>
										
									</div>
									<div class="well">
										<div>
											<h4>Selecione as Avaliações a serem atualizadas: </h4>
											<form type="post" action="delegaVarias">
												@foreach($avaliado as $b)
													<input type="hidden" value="'{{$b->CHAPAAVALIADOR}}'" name="chapaantigoavaliador">
												@endforeach 
												 <div class="checkbox">
													<label>
													  <input type="checkbox" class="check" id="checkAll"> <span class="text-danger">Todas Abaixo. (Só aparecerão abaixo as avaliações ainda não feitas)</span>
													</label>
												  </div>
												  <hr/>
												@foreach ($avaliado as $a)
													@if ($a->TEMAVALIACAO == 'N')
														<div class="checkbox m30">
															  <label>
																<input type="checkbox" class="check" value="{{ $a->CODPARTICIPANTE}}" name="participante{{$contador++}}">
																{{$a->NOMEAVALIACAO}} <br/> Líder Atual: <span class="text-info"> {{$a->NOMELIDER}} </span>
															  </label>
															  <input type="hidden" value="{{ $a->CODAVALIACAO}}" name="avaliacao">
														</div>
													@endif
												@endforeach	
												<hr/>
												<div class="center-block">
														<h4>Mudar Selecionadas para o (a) Seguinte Líder: </h4>
														<select name="avaliador" id="avaliador">
															@foreach($lideres as $l)
																<option value="'{{$l->CHAPA}}'" name="avaliador"> {{$l->NOME}} - {{$l->CHAPA}}</option>
															@endforeach
														</select>
														
														@foreach ($funcionario as $f)
												</div>
												<input type="hidden" value="{{$f->CHAPA}}" name="c"> @endforeach
												<div class="form-group" style="margin-top:15px;">
													<textarea class="form-control" name="obs" placeholder="Deixe uma observação (opcional)" rows="3"></textarea>
												</div>
												<input type="hidden" value="{{$xyz}}" name="xyz">
												<input type="hidden" value="{{$contador}}" name="contador">
												<div class="form-group" style="margin-top:15px;">
													<input class="btn btn-primary" type="submit" value="Enviar"/>
												</div>
											</form>
										</div>
									</div>
									
								</div>
                              
                            </div>
                        </div>
                        <!-- / Building Form. --> </div>
                    <!-- / Components --> </div>
                <!--form builder ends--> </div>
        </section>
        <!--main content ends--> 
@stop

{{-- page level scripts --}}
@section('footer_scripts')
  <script type='text/javascript' src="{{ asset('assets/vendors/bootstrap-progressbar/js/bootstrap-progressbar.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
  <script data-main="{{ asset('assets/vendors/bootstrap-form-builder/js/main-built.js') }}" src="{{ asset('assets/vendors/bootstrap-form-builder/js/require.js') }}" ></script>

	<script>
	$("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
	});

	
	</script>

@stop
