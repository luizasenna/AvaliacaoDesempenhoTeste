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
                <div class="col-md-12">
                           
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
                                
								<div class="col-md-12 panel-body">
									<form class="form-inline" action="media2016" >
										  <div class="form-group">
											<label for="setor">Equipe</label>
											<select name="equipe" id="equipe">
												
												<option>Selecione</option>
												@if($equipe_filter)
													<option value=""></option>
												@endif
												@foreach ($equipes as $e)
													<option value="{{$e->CODINTERNO}}" {{$e->CODINTERNO == $equipe_filter ? 'selected' : '' }}>{{$e->DESCRICAO}}</option>
												@endforeach
											</select>
										  </div>
										 
										  <button type="submit" class="btn btn-primary">Buscar</button>
									</form>
									<div>
										<table class="table table-stripped">
											<tr>
												<td>Chapa</td>
												<td>Avaliação</td>
												<td>Media</td>
												
											</tr>
											@foreach($total as $t)
											<tr>
												<td>{{$t->CHAPA}}</td>
												<td>{{$t->AVALIACAO}}</td>
												<td>{{$t->DESCRICAO}}</td>
												<td>{{$t->NOME}}</td>
												<td>{{$t->mediames}}</td>
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


@stop

{{-- page level scripts --}}
@section('footer_scripts')
  <script type='text/javascript' src="{{ asset('assets/vendors/bootstrap-progressbar/js/bootstrap-progressbar.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
  <script data-main="{{ asset('assets/vendors/bootstrap-form-builder/js/main-built.js') }}" src="{{ asset('assets/vendors/bootstrap-form-builder/js/require.js') }}" ></script>

	

@stop