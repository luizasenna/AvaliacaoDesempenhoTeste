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
                <li class="active">Ver Equipe</li>
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
                                <i class="livicon" data-name="help" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Time Atual
                            </h3>
                            <span class="pull-right clickable"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row clearfix">
								<div>
									<table class="table table-striped" >
										<th>#</th>
										<th>Chapa</th>
										<th>Nome</th>
										<th>Loja</th>
										<th>Codigo</th>
                                        <th>Demissão</th>
										<th>Ver / Editar</th>
										
										@foreach ($time as $e)
											<tr>
												<td>{{ $id++ }}</td>
												<td>{{ $e->CHAPA }}</td>
												<td>{{ $e->NOME }}</td>
												<td>{{ $e->CODFILIAL }}</td>
												<td>{{ $e->CODPESSOA }}</td>
												<td> {{$e->DATADEMISSAO != null ? date("d/m/Y",strtotime($e->DATADEMISSAO)) : 'Ativo (a)' }} </td>
												 <td>
													<a href="avaliado?c={{$e->CHAPA}}">
														<i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Ver / Editar Funcionário"></i>
													</a>
												</td>
											</tr>
										@endforeach
									</table>

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

@stop
