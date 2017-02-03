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
				 <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-danger ">
                            <div class="panel-heading ">
                                <h3 class="panel-title">
                                    <i class="glyphicon glyphicon-eye-open" data-name="glyphicon-eye-open" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                   Progresso das Avaliações
                                </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                            </div>
                            <div class="panel-body c2 collapsed">
                                @foreach ($porcento as $a)
                                <div>{{ $a->NOME}} - Participantes: {{$a->participantes }} | Feitos: {{ round($a->feitos,0) }} </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal='{{$a->total}}'></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
            
      
        </section>
        <!--main content ends--> 
@stop

{{-- page level scripts --}}
@section('footer_scripts')
  <script type='text/javascript' src="{{ asset('assets/vendors/bootstrap-progressbar/js/bootstrap-progressbar.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
  <script data-main="{{ asset('assets/vendors/bootstrap-form-builder/js/main-built.js') }}" src="{{ asset('assets/vendors/bootstrap-form-builder/js/require.js') }}" ></script>

@stop
