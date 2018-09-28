@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Relatório de Notas Baixas
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" />

@stop

{{-- Page content --}}
@section('content')
	<section class="content-header">
		<ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                        Dashboard =)
                    </a>
                </li>
                <li class="active">Médias Anuais</li>
            </ol>
	</section>
	 <section class="content">


            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                Funcionários com baixo desempenho
                            </h3>
                            <span class="pull-right clickable"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row ">

								<div class="col-lg-12 panel-body">
                  <div class="col-lg-8">

                    <form class="form-horizontal" method="get">
                      <div class="form-group">
                        <label for="dataInicial" class="col-sm-4 control-label">Data Inicial da Avaliação</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="dataInicial"  name="dataInicial"  value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="dataFinal" class="col-sm-4 control-label">Data Final da Avaliação</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="dataFinal"  name="dataFinal" value="">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">Buscar</button>
                        </div>
                      </div>
                    </form>

                  </div>
									<div class="col-lg-12">

									<div class="table-responsive">

											<a id="dlink"  style="display:none;"></a>

											<input class="btn btn-primary btn-lg" type="button" onclick="tableToExcel('notasBaixas', 'notasBaixas', 'ADNotasBaixas.xls')" value="Exportar para Excel">
											<!--<a class="btn btn-primary btn-lg" href="mediaImpressao" target="_blank" role="button">Versão para Impressão</a>-->
											<hr/>
											<table class="table table-striped" id="notasBaixas" style="overflow-x: scroll;">
                        @if($medias>0)
                        <tr>
														<td>Codigo</td>
														<td>Nome</td>
														<td>Avaliação</td>
														<td>Media</td>
														<td>Loja</td>
														<td>Seção</td>
														<td>Avaliador</td>
												</tr>
    													@foreach($medias as $m)
    														<tr>
    															<td>{{$m->CODPESSOA}}</td>
    															<td>{{$m->NOME}}</td>
    															<td>{{$m->AVALIACAO}}</td>
    															<td>{{$m->MEDIA}}</td>
    															<td>{{$m->LOJA}}</td>
    															<td>{{$m->CODSECAO}}</td>
    															<td>{{$m->AVALIADOR}}</td>
    														</tr>
    													@endforeach
                              @endif
											</table>

											<div class="col-md-9 pull-right">

											</div>


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


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js" type="text/javascript"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"> </script>

<script type="text/javascript">

	$('#dataInicial').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		language: 'pt-BR',
		todayBtn: 'linked',
		todayHighlight: true,
	});

	$('#dataFinal').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		language: 'pt-BR',
		todayBtn: 'linked',
		todayHighlight: true,
	});

</script>


  <script type='text/javascript' src="{{ asset('assets/vendors/bootstrap-progressbar/js/bootstrap-progressbar.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
  <script data-main="{{ asset('assets/vendors/bootstrap-form-builder/js/main-built.js') }}" src="{{ asset('assets/vendors/bootstrap-form-builder/js/require.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
  <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>

<script>
	$(document).ready(function() {
    $('#notasBaixas').DataTable( {
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
    })();

</script>

@stop
