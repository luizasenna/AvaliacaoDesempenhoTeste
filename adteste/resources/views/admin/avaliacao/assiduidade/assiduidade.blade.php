@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Assiduidade - AD
@parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/bootstrap-form-builder/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/formbuilder.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	  <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
            <!--section starts-->
            <h1>Assiduidade</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                        Dashboard
                    </a>
                </li>
                <li class="active">Cálculo de Assiduidade</li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
          <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                          <h3 class="panel-title">
                              <i class="fa fa-id-card-o" aria-hidden="true"></i>
                              Cálculo de Assiduidade na Avaliação do RH =)
                          </h3>
                      </div>
                      <div class="panel-body">
                          <div class="row ">
                              <div class="col-lg-12 panel-body">
                                <div class="col-lg-8" style="margin-bottom:20px;"><p>Pesquisar um Funcionário:</p>
                                    <form class="form-inline">
                                      <div class="form-group">
                                        <label for="nomeFuncionario">Chapa: </label>
                                        <input type="text" class="form-control" id="chapaFuncionario" name="chapaFuncionario" placeholder="Chapa">
                                      </div>  ou
                                      <div class="form-group">
                                        <label for="nomeFuncionario">Nome: </label>
                                        <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" placeholder="Insira o nome">
                                      </div>
                                      <button type="submit" class="btn btn-primary">Buscar</button>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                  <a class="btn btn-lg btn-danger pull-right" href="{{route('insereAssiduidade')}}" role="button">Inserir / Recalcular Assiduidade</a>
                                </div>

                                 <table class="table table-responsive table-striped">
                                    <th>Avaliação</th>
                                    <th>Ano</th>
                                    <th>Mês</th>
                                    <th>Usuário</th>
                                    <th>Criação</th>
                                    <th>Ações</th>
                                    @foreach ($todas as $t)
                                    <tr>
                                      <td class="col-lg-3">{{$t->avaliacao->NOME}}</td>
                                      <td class="col-lg-1">{{$t->ano}}</td>
                                      <td class="col-lg-1">{{$t->mes}}</td>
                                      <td class="col-lg-3">{{$t->usuario->first_name}} {{$t->usuario->last_name}}</td>
                                      <td class="col-lg-1">{{$t->created_at}}</td>
                                      <td class="col-lg-2">Ver / Excluir</td>
                                    </tr>
                                    @endforeach
                                 </table>
                              </div>
                          </div>
                      </div>
                  </div> <!-- fim do painel-->
                </div> <!-- fim da coluna-->

          </div> <!--fim da row-->
        </section>
        <!--main content ends-->
@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>


	<script>
	$(document).ready(function() {
		$('#table').DataTable();
	});
	</script>

@stop
