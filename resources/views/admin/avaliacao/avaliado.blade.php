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
                <li class="active">Avaliado</li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <!--main content-->
            
            <div class="row"> 
				 @if (session('status'))
							<div class="col-md-4"></div>
							<div id="alert_msg" class="center-block col-md-4 alert alert-info row-centered alert-dismissable pull-center center-block" tabindex="-1" >
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>{{ session('status') }}</strong>
						    </div>
							<div class="col-md-4"></div>
					@endif
					</div> 
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
								<div>
									
									<!-- Dados do funcionario -->
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
																<td><b>LIDER ATUAL:</b> {{$p->LIDER }} 
																	
																 </td>
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
											  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
															<a href="delega?xyz={{$funcionario[0]->CHAPA}}&a={{$a->CODAVALIACAO}}&p={{$a->CODPARTICIPANTE}}" class="btn btn-sm btn-warning">
																<span class="glyphicon glyphicon-wrench"></span> Delegar </a>
														@endif</td>
												</tr>
												@endforeach
											</table>
										
										
										
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
  
  <script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>



  

	

@stop
