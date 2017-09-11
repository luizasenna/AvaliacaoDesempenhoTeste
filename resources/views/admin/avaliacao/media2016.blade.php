@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Média Geral 2016
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/bootstrap-form-builder/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/formbuilder.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
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
		<ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                        Dashboard
                    </a>
                </li>
                <li class="active">Médias 2016</li>
            </ol>
	</section>
	 <section class="content">
	 
	       
            <div class="row">
                <div class="col-lg-12">
                           
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                Média Geral 2016
                            </h3>
                            <span class="pull-right clickable"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row ">
                                
								<div class="col-lg-12 panel-body">
									<form class="form-inline" action="media2016" >
										  <div class="form-group">
											<label for="setor">Equipe</label>
											<select name="equipe" id="equipe">
												<option value="0">Selecione</option>
												<option value="all">Todas</option>
												
												@foreach ($equipes as $e)
													<option value="{{$e->CODINTERNO}}" {{$e->CODINTERNO == $equipe_filter ? 'selected' : '' }}>{{$e->DESCRICAO}}</option>
												@endforeach
											</select>
										  </div>
										 
										  <button type="submit" class="btn btn-primary">Buscar</button>
									</form>
									<div class="col-lg-12">
									<div class="table-responsive">
										@if(isset($medias))
										@if(isset($equipe_filter) and $equipe_filter <> 0)
											<table class="table table-striped" id="media2016Tabela" style="overflow-x: scroll;">
												<tr>
														<td>Chapa</td>
														<td>Nome</td>
														<td>Função</td>
														<td>Admissão</td>
														<td>Feitas/Total</td>
														<td>Media</td>
														<td>Loja</td>
														<td>CodSecao</td>
														<td>Seção</td>
														<td>Avaliador</td>

													</tr>
													@foreach($medias as $m)
														<tr>	
															<td>{{$m->CHAPA}}</td>
															<td>{{$m->NOME}}</td>
															<td>{{$m->FUNCAO}}</td>
															<td>{{date('d/m/Y', strtotime($m->DATAADMISSAO))}}</td>
															<td>{{$m->FEITAS}}/{{$m->TOTAL}}</td>
															<td>{{$m->MEDIA}}</td>
															<td>{{$m->LOJA}}</td>
															<td>{{$m->CODSECAO}}</td>
															<td>{{$m->SECAO}}</td>
															<td>{{$m->AVALIADOR}}</td>
														</tr>
													@endforeach
											</table>
											
											<div class="col-md-9 pull-right">
												<a class="btn btn-default" href="mediaImpressao?e={{$equipe_filter}}" target="_blank" role="button">Versão para Impressão</a>
											</div>
										@endif
										@endif
									</div>
									
								</div>
                           		
                            </div>
                        </div>
                        <!-- / Building Form. --> </div>
                    <!-- / Components --> </div>
                <!--form builder ends--> </div>
	</section>
	
	



@stop

{{-- page level scripts --}}
@section('footer_scripts')
  <script type='text/javascript' src="{{ asset('assets/vendors/bootstrap-progressbar/js/bootstrap-progressbar.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
  <script data-main="{{ asset('assets/vendors/bootstrap-form-builder/js/main-built.js') }}" src="{{ asset('assets/vendors/bootstrap-form-builder/js/require.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>

<script>
	$(document).ready(function() {
    $('#media2016Tabela').DataTable( {
        "scrollX": true
    } );
} );
	

	
</script>

@stop