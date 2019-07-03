<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Média AD {{$ano}}</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <section class="content-header">
            <!--section starts-->
            <table class="table" width="100%">
                <tr class="col-md-12">
                    <td class="col-md-5" style="border: none;"><h4><img width="80px" style="margin-top:5px;" src="{{ asset('../../assets/images/logo.png') }}"/></h4></td>
                    <td class="col-md-7 pull-right" style="border: none;line-height:200%;"><h4><center>DEPARTAMENTO DE RECURSOS HUMANOS</center></h4></td>
                  <!--  <td class="col-md-5 pull-right" style="border: none;"><h5>Avaliação de Desempenho e Comportamento {{$ano}}</h5></td>-->
                </tr>
            </table>
            <center><h4>Avaliação de Desempenho e Comportamento {{$ano}}</h4></center>
    </section>
        <!--section ends-->
        <section class="content" >
    <!-- Aba de Título -->

    <div class="row" style="min-height:800px;" >
        <!--Content Section Start -->

    @if ($perm == '0' )
		<div class="col-md-12">
            <div class="panel panel-info" style="margin-top:0;padding:0;">
						<div class="panel-body"  style="padding:0;">
							<!-- Foto -->
							<div class="col-md-2" style="width:15%;float:left;margin-left:100px;;margin-bottom:0;padding:0;">
								@foreach ($funcionario as $f)
								<img width="80px" height="100px" style="margin-top:10px;" src="data:image/jpeg;base64,{{ base64_encode( $f->IMAGEM )}}"/>
								@endforeach
							</div>
							<!-- Foto -->
							<!-- Dados do funcionario -->
							<div class="col-md-6 pull-right" style="width:61%;margin-right:56px;padding-bottom:0;margin-bottom:0;margin-top:10px;">
									<table class="table col-md-6" >
										    @if (!$funcionario)
												{{"Pessoa não encontrada"}}
											  @else
												@foreach ($funcionario as $p)
													<tr >
														<td colspan ="2" style="border: none;"><h4 style="padding:0;margin:0;">{{$p->NOME}}</h4></td>
													</tr>
													<tr style="font-size:11px;">
														<td>CODIGO: {{$p->CHAPA}} </td>
														<td>FUNÇÃO: {{$p->CARGO}} </td>
													</tr>
													<tr style="font-size:11px;">
														<td>ADMISSÃO: {{date("d/m/Y", strtotime($p->DATAADMISSAO))}}</td>
														<td>FILIAL: {{$p->FILIAL}}  | SEÇÃO: {{$p->NOMESECAO}}</td>
													</tr>
												@endforeach
											@endif
										</table>
							</div><!-- Dados do funcionario -->
						</div>
				</div>
				</div>

		 <!-- Competências -->
		<div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h5 class="panel-title">Competências Avaliadas para a Função</h5>
                    </div>
					<div class="panel-body panel-collapse collapse in" id="collapse1" >
					<!--<div class="panel-body"  >-->
							<table class="table" style="font-size:10px;">
								<tr>
								@foreach ($compfuncao as $c)
    									@if ($c->c1 == 0)
    									<td  style="border: none;" id="comp01">01 - Aprendizagem e Adaptação</td>
    									@else
    									<td  style="border: none;" id="comp01" style="color:#bbb;"><strike>01 - Aprendizagem e Adaptação</strike> <span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c2 == 0)
    									<td  style="border: none;" id="comp02">02 - Apresentação Pessoal</td>
    									@else
    									<td  style="border: none;" id="comp02" style="color:#bbb;"><strike>02 - Apresentação Pessoal</strike><span class="text-danger">(inativo) </span></td>
    									@endif
    									<td  style="border: none;" id="comp03" >03 - Assiduidade </td>
								</tr>
								<tr>
    									@if ($c->c4 == 0)
    									<td id="comp04" >04 - Comunicação </td>
    									@else
    									<td id="comp04" style="color:#bbb;"><strike>04 - Comunicação</strike> <span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c5 == 0)
    									<td id="comp05" >05 - Disciplina e Respeito </td>
    									@else
    									<td id="comp05" style="color:#bbb;"><strike>05 - Disciplina e Respeito </strike><span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c6 == 0)
    									<td id="comp06" >06 - Estabilidade Emocional </td>
    									@else
    									<td id="comp06" style="color:#bbb;"><strike>06 - Estabilidade Emocional</strike> <span class="text-danger">(inativo) </span></td>
    									@endif
								</tr>
								<tr>
    									@if ($c->c7 == 0)
    									<td id="comp07" >07 - Hábitos de Segurança, Higiene e Zelo</td>
    									@else
    									<td id="comp07" style="color:#bbb;"><strike>07 - Hábitos de Segurança, Higiene e Zelo</strike> <span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c8 == 0)
    									<td id="comp08" >08 - Iniciativa e Criatividade</td>
    									@else
    									<td id="comp08" style="color:#bbb;"><strike>08 - Iniciativa e Criatividade </strike><span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c9 == 0)
    									<td id="comp09" >09 - Interesse, Dedicação e Sigilo</td>
    									@else
    									<td id="comp09" style="color:#bbb;"><strike>09 - Interesse, Dedicação e Sigilo</strike> <span class="text-danger">(inativo) </span></td>
    									@endif
								</tr>
								<tr>
    									@if ($c->c10 == 0)
    									<td id="comp10" >10 - Organização</td>
    									@else
    									<td id="comp10" style="color:#bbb;"><strike>10 - Organização </strike><span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c11 == 0)
    									<td id="comp11" >11 - Pontualidade</td>
    									@else
    									<td id="comp11" style="color:#bbb;"><strike>11 - Pontualidade</strike> <span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c12 == 0)
    									<td id="comp12" >12 - Produtividade</td>
    									@else
    									<td id="comp12" style="color:#bbb;"><strike>12 - Produtividade </strike><span class="text-danger">(inativo) </span></td>
    									@endif
								</tr>
								<tr>
    									@if ($c->c13 == 0)
    									<td id="comp13" >13 - Qualidade</td>
    									@else
    									<td id="comp13" style="color:#bbb;"><strike>13 - Qualidade </strike><span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c14 == 0)
    									<td id="comp14" >14 - Relacionamento Pessoal e Colaboração</td>
    									@else
    									<td id="comp14" style="color:#bbb;"><strike>14 - Relacionamento Pessoal e Colaboração </strike><span class="text-danger">(inativo) </span></td>
    									@endif
    									@if ($c->c15 == 0)
    									<td id="comp15" >15 - Administração</td>
    									@else
    									<td id="comp15" style="color:#bbb;"><strike>15 - Administração </strike><span class="text-danger">(inativo) </span></td>
    									@endif
								</tr>	@endforeach
							</table>
					</div>
				</div>
		</div>
		<!-- Competências -->

    <!--Adicionado Notas-->
    <div class="col-md-12">

                        <!-- Dados da avaliação -->
                                        <table class="table table-bordered" style="padding:0;margin-bottom:0;">
                                          @if ($resultado)
                                            <tr style="font-size:10px;">
                                              <td>MÊS / ANO</td>
                                              <td>01</td>
                                              <td>02</td>
                                              <td>03</td>
                                              <td>04</td>
                                              <td>05</td>
                                              <td>06</td>
                                              <td>07</td>
                                              <td>08</td>
                                              <td>09</td>
                                              <td>10</td>
                                              <td>11</td>
                                              <td>12</td>
                                              <td>13</td>
                                              <td>14</td>
                                              <td>15</td>
                                              <td>MÉDIA</td>
                                              <td>AVALIADOR</td>
                                            </tr>
                                          @else Nenhuma Nota ainda cadastrada para este funcionário. Começe a fazer avaliações <a class="info" href="http://rh.pintos.com.br/avaliacao">na Área de Avaliações Abertas</a>.
                                          @endif
                                        <!-- conteúdo dos collapses -->
                                        @foreach ($compfuncao as $c)

                                            @foreach ($resultado as $n)

                                                <tr style="font-size:10px;">
                                                    <td>{{ substr($n->DESCRICAO,11,16) }}</td>
                                                    <td>@if ($c->c1==0){{$n->NOTA1}}  @else - @endif</td>
                                                    <td>@if ($c->c2==0){{$n->NOTA2}}  @else - @endif</td>
                                                    <td>{{$n->NOTA3}} </td>
                                                    <td>@if ($c->c4==0){{$n->NOTA4}} @else - @endif</td>
                                                    <td>@if ($c->c5==0){{$n->NOTA5}} @else - @endif</td>
                                                    <td>@if ($c->c6==0){{$n->NOTA6}} @else - @endif</td>
                                                    <td>@if ($c->c7==0){{$n->NOTA7}} @else - @endif</td>
                                                    <td>@if ($c->c8==0){{$n->NOTA8}} @else - @endif</td>
                                                    <td>@if ($c->c9==0){{$n->NOTA9}} @else - @endif</td>
                                                    <td>@if ($c->c10==0){{$n->NOTA10}} @else - @endif</td>
                                                    <td>@if ($c->c11==0){{$n->NOTA11}} @else - @endif</td>
                                                    <td>@if ($c->c12==0){{$n->NOTA12}} @else - @endif</td>
                                                    <td>@if ($c->c13==0){{$n->NOTA13}} @else - @endif</td>
                                                    <td>@if ($c->c14==0){{$n->NOTA14}} @else - @endif</td>
                                                    <td>@if ($c->c15==0){{$n->NOTA15}} @else - @endif</td>
                                                    <td> @if($n->ANO < date('Y')) {{round($n->MEDIA,2)}} @else - @endif</span></td>
                                                    <td style="font-size:8px;">{{$n->AVALIADOR}}</td>

                                                </tr>
                                                 @endforeach
                                                </table>
                    @endforeach
                    <div class="panel panel-info" style="margin-top:20px;">
                      <div class="panel-heading">
                          <h5 class="panel-title">Observações deixadas pelos Avaliadores</h5>
                      </div>
        						<div class="panel-body"  style="padding:0;">

                    <table class="table table-bordered" width="100%" style="font-size:9px;">

                        @foreach($meses as $m)
                        <tr style="font-size:9px;">
                            <td class="col-md-2"> <b>{{ substr($m->DESCRICAO,11,16) }} </b></td>
                            <td>

                              @foreach($observacoes as $res)
                                 @if($m->AVALIACAO == $res->AVALIACAO)
                                        <b>ITEM {{$res->ITEM}}:</b>  {{ utf8_encode($res->OBS)}}  <br/>
                                 @endif
                              @endforeach
                            </td>
                            </tr>
                        @endforeach
                    </table>
                  </div>
              </div>
            </div>
        <!-- Dados da avaliação -->


		 <!-- Avaliações -->
	@else
	@endif
    </div>
</body>
</html>
