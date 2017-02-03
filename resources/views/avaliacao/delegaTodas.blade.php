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
		<div class="col-md-12" style="min-height:800px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="list-ul" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Delegando Avaliação</h3>
                    </div>
  
                    <div class="panel-body">
						<div class="well col-md-9">
								<h4>Delegando a Avaliacao de<span class="text-info"> @foreach ($funcionario as $f){{$f->NOME}}@endforeach</span></h4>
								<hr/>
									<div>
											<h4>Selecione as Avaliações a serem atualizadas: </h4>
											<div><span class="small">Só aparecerão abaixo as avaliações ainda não feitas</span></div>
											<form type="post" action="delegaVarias">
												@foreach($avaliado as $b)
													<input type="hidden" value="'{{$b->CHAPAAVALIADOR}}'" name="chapaantigoavaliador">
												@endforeach 
												 <div class="checkbox">
													<label>
													  <input type="checkbox" class="check" id="checkAll"> <span class="text-danger">Todas Abaixo. </span>
													</label>
												  </div>
												  <hr/>
												@foreach ($avaliado as $a)
													@if ($a->TEMAVALIACAO == 'N')
													
														<div class="checkbox m20">
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
												</div>
												@foreach ($funcionario as $f)
												<input type="hidden" value="{{$f->CHAPA}}" name="c"> @endforeach
												<input type="hidden" value="{{$contador}}" name="contador">
												<div class="form-group" style="margin-top:15px;">
													<textarea class="form-control" name="obs" placeholder="Deixe uma observação (opcional)" rows="3"></textarea>
												</div>
												<div class="form-group" style="margin-top:15px;">
													<input class="btn btn-primary" type="submit" value="Enviar"/>
												</div>
											</form>
										</div>
										</div>
						
						</div>
						
						
					</div>
				</div>
				</div>		
        <!-- //Content Section End -->
		
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
	<script>
	$("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
	});

	
	</script>
@stop
