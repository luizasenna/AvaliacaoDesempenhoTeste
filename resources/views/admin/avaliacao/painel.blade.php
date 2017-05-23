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
                    
                    <div class="well">
                        
                        Filtrar por:
                        <div class="row">
                        <form class="form-inline">
                          <div class="col-md-3"><label for="chapa">Chapa: </label>
                              <div class="form-group">
                                <input size="14" type="text" class="form-control" name="chapa" id="chapa" placeholder="Chapa">
                              </div>
                          </div>
                          <div class="col-md-7"><label for="nome">Nome: </label> 
                          <div class="form-group">
                            <input size="30" type="text" class="form-control" name="nome" placeholder="Insira um nome para buscar">
                          </div>
                          </div>  
                          <div class="col-md-2"></div>              
                          <div class="col-md-6" style="margin-top: 8px;">          
                          <div class="form-group">
                            <label for="equipe">Equipe</label>
                            <select class="form-control" id="codequipe" name="codequipe">
                                <option value="">Todas</option>
                                @foreach($equipes as $e)
                                    <option value="{{$e->CODINTERNO}}">{{$e->DESCRICAO}}</option>
                                @endforeach
                            </select>
                          </div>
                          </div>
                          <div class="col-md-1" style="margin-top: 8px;">
                          <button type="submit" class="btn btn-primary">Buscar</button>
                          </div>
                          <div class="col-md-5"></div>
                        </form>
                        </div>
                    </div>       
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
										<TH>Chapa</TH>
                    <th>Cód Pessoa</th>
										<th>Nome</th>
                    <th>Demissão</th>
                    <th>Equipe</th>
                    <th>Ação</th>

										@foreach ($people as $p)
											<tr>
												<td>{{ $p->CHAPA }}</td>
                        <td>{{ $p->CODPESSOA }}</td>
												<td>{{ $p->NOME }}</td>
                        <td>@if( is_null($p->DATADEMISSAO)) Atual
                                 @else {{ date('d/m/Y', strtotime($p->DATADEMISSAO)) }}
                                 @endif 
                        </td>
                        <td>{{ $p->equipe->DESCRICAO }}</td>
                        <td> <a href="{{ route('pessoa_show', $p->CHAPA) }}" title="Mostrar"><span class="glyphicon glyphicon-search"></span></a></td>
											</tr>
										@endforeach
									</table>
                                    <div class="col-md-12 text-center">
                                       {!! $people->appends(Input::except('page'))->render() !!} 
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

@stop
