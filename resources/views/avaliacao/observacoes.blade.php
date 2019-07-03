@extends('layouts/default')

{{-- Page title --}}
@section('title')
Avaliação de Desempenho dos Funcionários
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
 <!--page level css starts-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/panel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/features.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/switchery/css/switchery.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}">
    <!--end of page level css-->
@stop
{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i>
                    <a href="#">Avaliação de Desempenho</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="barchart" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Avaliação de Desempenho
            </div>
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')

<div class="text-center">
   <h3 class="border-primary"><span class="heading_border bg-primary">
        <i class="livicon icon3" data-name="barchart" data-size="30" data-loop="true" data-c="#ffffff" data-hc="red"></i>
        Avaliação de Desempenho</span></h3>
</div>
<center>
    <div class="col-md-4 pull-center">
      @if (session('status'))
        <div id="alert_msg" class="alert alert-info alert-dismissable">
            <strong>{{ session('status') }}</strong>
        </div>
      @endif
    </div>
</center>
<div class="container" style="min-height:800px;">
    <!--Content Section Start -->
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Painel de Observações</h3>
          </div>
          <div class="panel-body">
              <!-- Dados do funcionario -->
              <div class="col-md-2"></div>
              <div class="col-md-6">
                  <table class="table table-striped ">
                        @if (!$pessoa)
                        {{"Pessoa não encontrada"}}
                      @else

                        @foreach ($pessoa as $p)
                          <tr>
                            <td colspan ="2" >NOME: {{$p->NOME}}</td>
                          </tr>
                          <tr>
                            <td>CHAPA: {{$p->CHAPA}} </td>
                            <td>CARGO: {{$p->CARGO}} </td>
                          </tr>
                          <tr>
                            <td>ADMISSÃO: {{date("d/m/Y", strtotime($p->DATAADMISSAO))}}</td>
                            <td></td>
                          </tr>
                          @endforeach
                      @endif
                    </table>
          </div>
          <div class="col-md-2">
            @foreach ($pessoa as $f)
            <!--<img src="/assets/images/avaliacao/avatar.png" width="180px" height="180px"/>-->
            {{  $f->IMAGEM }}
            <img width="90px" height="110px" src="data:image/jpeg;base64,{{ base64_encode( $f->IMAGEM )}}"/>
            @endforeach
          </div>

				<div class="col-md-2" style="min-height:150px;"></div>
				<hr/>
        <div class="col-md-2"></div>
        <div class="col-md-8 bordered">
					<h4>Observações lançadas para o (a) funcionário(a)</h4>

          <table class="table table-striped">
							<th>Data</th>
							<th>Usuário</th>
							<th>Observação</th>
              @foreach ($obs as $o)
                <tr>
                    <td>{{$o->created_at}}</td>
										<td>{{$o->idusuario}} </td>
										<td>{{$o->observacao}}</td>
                </tr>
              @endforeach
          </table>
				<!-- <span class="alert-warning">Não existem observações lançadas ainda para esta pessoa.</span>-->

        </div>
				<div class="col-md-2"></div>
				<div class="col-md-12">
					 <div class="col-md-4"></div>
					 <div class="col-md-4">
						 <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
							 Nova Observação
						 </button>

					 </div>
					 <div class="col-md-4"></div>

				</div>

				<!-- Button trigger modal -->

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Nova Observação</h4>
				      </div>
				      <div class="modal-body">
				        <div></div>
								<div class="well">
									  Data: {{date('d/m/Y')}} <hr/><br/>
										<form action="insereobs/" >
											<textarea name="observacao" class="form-control" rows="3" placeholder="Escreva aqui..."></textarea>
											<input type="hidden" value="{{$chapa}}" name="chapa"/>
											<input type="submit" class="btn btn-primary" value="Inserir"/>
										</form>
								</div>
				      </div>
				      <div class="modal-footer">

				      </div>
				    </div>
				  </div>
				</div>




      </div> <!-- fim do painel-->
        <!- fim coluna12 -->

  </div>
</div>
</div>
</div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/advfeatures.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
@stop
