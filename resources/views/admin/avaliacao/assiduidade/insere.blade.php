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
                <li class="active">Inserir Assiduidade para Mês</li>
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
                              Inserir Assiduidade na Avaliação do RH
                          </h3>
                      </div>
                      <div class="panel-body">
                          <div class="row ">
                              <div class="col-lg-12 panel-body">
                                <form class="form-horizontal" action="{{route('insereNovaAssiduidade')}}" method="post">
                                  {!! Form::token() !!}
                                  <div class="form-group">
                                    <label for="codavaliacao" class="col-sm-2 control-label">Avaliação</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="novaAvaliacao">
                                        @foreach ($novas as $n)
                                            <option value="{{$n->cod}}">{{$n->cod}} - {{$n->nome}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary">Calcular</button>
                                    </div>
                                  </div>
                                </form>

                              </div>
                          </div>
                      </div> <!-- fim do painel corpo-->
                    </div> <!-- fim do painel-->

                    <div class="panel panel-primary">
                      <div class="panel-heading">
                          <h3 class="panel-title">
                              <i class="fa fa-id-card-o" aria-hidden="true"></i>
                              Recalcular Assiduidade na Avaliação do RH
                          </h3>
                      </div>
                      <div class="panel-body">
                          <div class="row ">
                              <div class="col-lg-12 panel-body">
                                <form class="form-horizontal" action="{{route('atualizaAssiduidade')}}" method="post">
                                  {!! Form::token() !!}
                                  <div class="form-group">
                                    <label for="codavaliacao" class="col-sm-2 control-label">Avaliação</label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="atualizaAvaliacao">
                                        @foreach ($feitas as $f)
                                            <option value="{{$f->cod}}">{{$f->cod}} - {{$f->nome}}</option>
                                        @endforeach
                                      </select>
                                      </select>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary">Recalcular</button>
                                    </div>
                                  </div>
                                </form>

                              </div>
                          </div>
                      </div> <!-- fim do painel corpo-->
                    </div> <!-- fim do painel-->
                  </div> <!--fim da coluna-->
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
