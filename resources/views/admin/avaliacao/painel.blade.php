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
                <li class="active">Avaliação de Desempenho</li>
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
                                Painel de Avaliações
                            </h3>
                            <span class="pull-right clickable"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row clearfix">
								<div>
									<table class="table table-striped" >
										<th>Código Pessoa TOTVS</th>
										<th>Nome</th>

										@foreach ($a as $p)
											<tr>
												<td>{{ $p->CODPESSOA }}</td>
												<td>{{ $p->NOME }}</td>
											</tr>
										@endforeach
									</table>
									<nav aria-label="...">
									  <ul class="pagination">
										<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
										<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
										{{$pessoas->render()}}
									  </ul>
									</nav>
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
