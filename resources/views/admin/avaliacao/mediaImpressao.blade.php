<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Média AD 2016</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
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
									<div class="table-responsive">
									 @foreach($lider as $l)
                               			<div class="col-md-6"><h5>LÍDER: {{$l->NOME}}</h5></div>
                               		 @endforeach
										<table class="table table-striped" id="media2016Tabela" style="overflow-x: scroll;">
												<tr>
														<td>Chapa</td>
														<td>Nome</td>
														<td>Função</td>
														<td>Admissão</td>
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
															<td>{{$m->MEDIA}}</td>
															<td>{{$m->LOJA}}</td>
															<td>{{$m->CODSECAO}}</td>
															<td>{{$m->SECAO}}</td>
															<td>{{$m->AVALIADOR}}</td>
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


</body>
</html>
