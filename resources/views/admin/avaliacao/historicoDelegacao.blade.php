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
                <li class="active">Histórico de Delegações de Avaliações</li>
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
                                Histórico de Delegação de Avaliações
                            </h3>
                            <span class="pull-right clickable"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row ">
                                
								<div>
									<div class="col-md-12 panel-body">
                                        <div style="margin-bottom: 20px;">
                                            <form class="form-inline" action="/avaliacao/historicoDelegacao/filtro" method="POST">
                                              <div class="form-group">
                                                <label for="lider_filter">Filtrar por Lider: </label>
                                                <select name="lider_filter">
                                                    <option class="text-uppercase" value="0">Todos</option>
                                                    @foreach($lideres as $l)
                                                        <option class="text-uppercase" value="{{$l->CODINTERNO}}">{{$l->DESCRICAO}} - {{$l->CODINTERNO}}</option>
                                                    @endforeach

                                                </select>
                                              </div>
                                             
                                              <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-out"></span> Filtrar</button>
                                            </form>
                                            
                                            <form class="form-inline" style="margin-top: 5px;" action="/avaliacao/historicoDelegacao/busca" method="POST">
                                              <div class="form-group">
                                              <label for="funcionario">Buscar um Avaliado: </label>
                                                <input type="text" size="48" name="funcionario" placeholder="Insira um nome">                                                
                                              </div>
                                             
                                              <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span>Buscar</button>
                                            </form>
                                             
                                        </div>
										<table class="table table-striped">
											<tr>
												<th>Usuário</th>
												<!--<th>Data</th>-->
												<th>Avaliado</th>
												<th>Avaliação</th>
												<th>Avaliado Anterior</th>
												<th>Avaliado Atual</th>
												
											</tr>
											
											@foreach ($historico as $h)
											<tr>
												<td>{{$h->usuario? $h->usuario->first_name: '---'}}</td>
												<!--<td> {{ date('d/m/Y', strtotime($h->created_at)) }}</td>-->
												<td>{{$h->avaliado? $h->avaliado->NOME: '---'}}</td>
												<td>{{$h->avaliacao? $h->avaliacao->NOME: '---'}}</td>
												<td>{{$h->antigoavaliador? str_limit($h->antigoavaliador->NOME, 13): '---'}}</td>
												<td>{{$h->novoavaliador? str_limit($h->novoavaliador->NOME, 13): '---'}}</td>
												
											</tr>
											@endforeach
											
										</table>
									{!! $historico->render() !!}
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
