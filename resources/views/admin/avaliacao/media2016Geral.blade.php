@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Média Geral 2016 - Todas as Equipes
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/bootstrap-form-builder/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/formbuilder.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
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
                <div class="col-lg-12">
                           
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
                                
								<div class="col-lg-12 panel-body">

									<div class="col-lg-12">
									<div class="table-responsive">
										@if(isset($medias))
											<a id="dlink"  style="display:none;"></a>

											<input class="btn btn-primary btn-lg" type="button" onclick="tableToExcel('media2016Tabela', 'media2016Tabela', 'AD2016Geral.xls')" value="Exportar para Excel"> 
											<hr/>
											<table class="table table-striped" id="media2016Tabela" style="overflow-x: scroll;">
												<tr>
														<td>Chapa</td>
														<td>Nome</td>
														<td>Função</td>
														<td>Admissão</td>
														<td>Feitas/Total</td>
														<td>Media</td>
														<td>Loja</td>
														<td>CodSecao</td>
														<td>Seção</td>
														<td>Avaliador</td>

													</tr>
													@foreach($medias as $m)
														<tr>	
															<td>{{$m->CHAPA}}</td>
															<td>{{$m->NOME}}</td>
															<td>{{$m->FUNCAO}}</td>
															<td>{{date('d/m/Y', strtotime($m->DATAADMISSAO))}}</td>
															<td>{{$m->FEITAS}} de {{$m->TOTAL}}</td>
															<td>{{$m->MEDIA}}</td>
															<td>{{$m->LOJA}}</td>
															<td>{{$m->CODSECAO}}</td>
															<td>{{$m->SECAO}}</td>
															<td>{{$m->AVALIADOR}}</td>
														</tr>
													@endforeach
											</table>
											
											<div class="col-md-9 pull-right">
												<a class="btn btn-default" href="mediaImpressaoGeral" target="_blank" role="button">Versão para Impressão</a>
											</div>
										@endif
										
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
  <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>

<script>
	$(document).ready(function() {
    $('#media2016Tabela').DataTable( {
        "scrollX": true
    } );
} );
	
	var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta charset="UTF-8" /></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();

        }
    })()
	
</script>

@stop