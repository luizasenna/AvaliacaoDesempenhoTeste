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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
            <!--section starts-->
            <h1>Mudar Equipe de Avaliação de Desempenho</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                        Dashboard
                    </a>
                </li>
                <li class="active">Mudar Equipe de Avaliação de Desempenho</li>
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
                                Mudar Equipe de @foreach ($funcionario as $f) {{$f->NOME}}@endforeach
                            </h3>
                            <span class="pull-right clickable"></span>

                        </div>
                        <div class="panel-body">
                            <div class="row clearfix">
								<div class="well">
                                    @foreach ($equipe as $e)
    									Equipe Atual: {{$e->DESCRICAO}} - {{$ae = $e->CODINTERNO}} <br>
                                    @endforeach

                                    <br>
                                    Mudar para a Equipe do Seguinte Líder: 
                                    <form action="outraEquipe" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <select id="equipe" name="equipe">
                                        @foreach ($lideres as $l)
                                            <option  value="{{$l->CODINTERNO}}">{{$l->DESCRICAO}} - {{$l->CODINTERNO}}</option>
                                        @endforeach
                                        </select>
                                        <input type="hidden" name="xyz" value="{{$xyz}}">
                                       <input type="hidden" name="antigaequipe" value="{{$equipe[0]->CODINTERNO}}">
                                        <input type="submit" class="btn btn-md btn-info" value="Enviar Solicitação">        
                                    </form>
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

    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
 

	<script>
	$(document).ready(function() {
		$('#table').DataTable();
	});
	</script>

@stop
