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
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="{{route('avaliacao')}}">Avaliação de Desempenho</a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="{{route('mostra')}}?id={{$avaliacao[0]->CODAVALIACAO}}">{{$avaliacao[0]->NOME}}</a>
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
    <!-- Aba de Título -->
    <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary"> 
				<i class="livicon icon3" data-name="barchart" data-size="30" data-loop="true" data-c="#ffffff" data-hc="red"></i>
				Avaliação de Desempenho</span></h3>
        </div>	<center>
        <div class="col-md-4 pull-center">
			@if (session('status'))
		<div id="alert_msg" class="alert alert-info alert-dismissable">
			<strong>{{ session('status') }}</strong>
		</div>
		@endif
	</div></center>
    
    
    <div class="container" >
        <!--Content Section Start -->
		<div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
						<i class="livicon icon3" data-name="user" data-size="20" data-loop="true" data-c="#ffffff" data-hc="#ffffff"></i>
						Avaliar Funcionario</h3>
                    </div>
                    <div class="panel-body">
						 <!--  Consulta de Solicitações --> 
                 				<div class="alert alert-warning">
                                    
                                    <H3 style="line-height:20px;">Antes de Prosseguir, confira atentamente os dados abaixo: </h3>
                                    <br/>
                                    @foreach ($imagem as $i)
                                    <div style="z-index: 5;" class="col-md-2"><img width="150px" height="180px" src="data:image/gif;base64,{{ base64_encode( $i->IMAGEM )}}"/> </div>
                                    @endforeach
                                    <div>
                                    <H4 style="line-height:25px;">
										
                                    <span class="text-info">Avaliação: </span> @foreach ($avaliacao as $a){{$a->NOME }} <span class="text-info">| Código: </span> {{$av = $a->CODAVALIACAO }} @endforeach  
									<br/>  
									<span class="text-info">Avaliado (a): </span> @foreach ($avaliado as $b){{$b->NOME}} <span class="text-info">| Chapa: </span>{{$b->CHAPA}} @endforeach
									<br/>
									<span class="text-info">Avaliador (a): </span>@foreach ($lider as $c){{$c->NOME}}  <span class="text-info">| Chapa: </span>{{$c->CHAPA}} @endforeach
									<br/>
									@if (isset($participante))
           									<span class="text-info">Participante:</span>  @foreach ($participante as $p){{$pt = $p->CODPARTICIPANTE}} @endforeach
           							@endif
           							</div>
           							<br/></h4>
           							<H4 style="line-height:25px;">
           							Legenda: <br/>
           							P - Péssimo | RU - Ruim | RE - Regular | B - Bom | MB - Muito Bom | E - Excelente
           							<br/>
                                    </H4>
                                </div>
								
                                 <form action="inserevalor/" >
                                    <div class="col-md-12">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="avaliacao" value="{{$av}}">
                                        <input type="hidden" name="participante" value="{{$pt}}">
                                        
																						
										
											 @foreach ($comps as $c)	
												<h3 class="text-info"><?=$contador++ ?> - {{$c->NOME }}</h3>
                                                <h4> {{$c->CONCEITO}}</h4>
											    <div id="notas{{$c->CODCOMPETENCIA}}">
												<div class="radio" >
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="0" required> 0 - P
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="1" required> 1 - P
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="2" required> 2 - P
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="3" required> 3 - RU
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="4" required> 4 - RU
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="5" required> 5 - RE
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="6" required > 6 - RE
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="7" required> 7 - B
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="8" required> 8 - B
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="9" required> 9 - MB
													</label>
													<label class="radio-inline">
													  <input type="radio" name="id{{$c->CODCOMPETENCIA}}"  value="10" required> 10 - E
													</label>
												</div>
												
												<textarea name="obs{{$c->CODCOMPETENCIA}}" class="form-control" rows="1" placeholder="Observações"></textarea>
											</div>
											
                                        @endforeach
                                       <button type="submit" class="btn btn-success" style="margin:25px;">
                                       <span class="glyphicon glyphicon-ok"></span> Inserir Avaliação de Desempenho para o funcionário
                                       </button> 
                                    </div>
                                   
						 </form>
                       
						 
						<!--  Consulta de Solicitações--> 
						
					</div>
				</div>
				</div>		
  
   
        
        <!-- //Content Section End -->
	
	
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
{{-- Scripts --}}
    
       
            <script>
			if (<?php echo ($d1); ?> == 1) 
            { 
				$('#notas1 *').prop('disabled',true);
				var div = document.getElementById('notas1');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id1";
                inputnota.id = "id1";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs1";      
                input2.id = "obs1";   
                
                document.getElementById("notas1").appendChild(inputnota);         
                document.getElementById("notas1").appendChild(input2);
				
				
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d2); ?> == 1) 
            { 
				$('#notas2 *').prop('disabled',true);
				var div = document.getElementById('notas2');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback

				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id2";
                inputnota.id = "id2";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs2";      
                input2.id = "obs2";   
                
                document.getElementById("notas2").appendChild(inputnota);         
                document.getElementById("notas2").appendChild(input2);
				
				               
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d3); ?> == 1) 
            { 
				$('#notas3 *').prop('disabled',true);
				var div = document.getElementById('notas3');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id3";
                inputnota.id = "id3";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' teste ';
                input2.name = "obs3";      
                input2.id = "obs3";   
                
                document.getElementById("notas3").appendChild(inputnota);         
                document.getElementById("notas3").appendChild(input2);
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d4); ?> == 1) 
            { 
				$('#notas4 *').prop('disabled',true);
				var div = document.getElementById('notas4');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback

				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id4";
                inputnota.id = "id4";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs4";      
                input2.id = "obs4";   
                
                document.getElementById("notas4").appendChild(inputnota);         
                document.getElementById("notas4").appendChild(input2);
				
				
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
            if (<?php echo ($d5); ?> == 1) 
            { 
				$('#notas5 *').prop('disabled',true);
				var div = document.getElementById('notas5');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback

				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id5";
                inputnota.id = "id5";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs5";      
                input2.id = "obs5";   
                
                document.getElementById("notas5").appendChild(inputnota);         
                document.getElementById("notas5").appendChild(input2);
				
								
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d6); ?> == 1) 
            { 
				$('#notas6 *').prop('disabled',true);
				var div = document.getElementById('notas6');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback

				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id6";
                inputnota.id = "id6";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs6";      
                input2.id = "obs6";   
                
                document.getElementById("notas6").appendChild(inputnota);         
                document.getElementById("notas6").appendChild(input2);
				
								
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d7); ?> == 1) 
            { 
				$('#notas7 *').prop('disabled',true);
				var div = document.getElementById('notas7');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback

				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id7";
                inputnota.id = "id7";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs7";      
                input2.id = "obs7";   
                
                document.getElementById("notas7").appendChild(inputnota);         
                document.getElementById("notas7").appendChild(input2);
				
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d8); ?> == 1) 
            { 
				$('#notas8 *').prop('disabled',true);
				var div = document.getElementById('notas8');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback

				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id8";
                inputnota.id = "id8";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs8";      
                input2.id = "obs8";   
                
                document.getElementById("notas8").appendChild(inputnota);         
                document.getElementById("notas8").appendChild(input2);
				
								
				
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
            if (<?php echo ($d9); ?> == 1) 
            { 
				$('#notas9 *').prop('disabled',true);
				var div = document.getElementById('notas9');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id9";
                inputnota.id = "id9";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs9";      
                input2.id = "obs9";   
                
                document.getElementById("notas9").appendChild(inputnota);         
                document.getElementById("notas9").appendChild(input2);
				
				
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d10); ?> == 1) 
            { 
				$('#notas10 *').prop('disabled',true);
				var div = document.getElementById('notas10');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id10";
                inputnota.id = "id10";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs10";      
                input2.id = "obs10";   
                
                document.getElementById("notas10").appendChild(inputnota);         
                document.getElementById("notas10").appendChild(input2);
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d11); ?> == 1) 
            { 
				$('#notas11 *').prop('disabled',true);
				var div = document.getElementById('notas11');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id11";
                inputnota.id = "id11";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs11";      
                input2.id = "obs11";   
                
                document.getElementById("notas11").appendChild(inputnota);         
                document.getElementById("notas11").appendChild(input2);
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d12); ?> == 1) 
            { 
				$('#notas12 *').prop('disabled',true);
				var div = document.getElementById('notas12');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id12";
                inputnota.id = "id12";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs12";      
                input2.id = "obs12";   
                
                document.getElementById("notas12").appendChild(inputnota);         
                document.getElementById("notas12").appendChild(input2);
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d13); ?> == 1) 
            { 
				$('#notas13 *').prop('disabled',true);
				var div = document.getElementById('notas13');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id13";
                inputnota.id = "id13";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs13";      
                input2.id = "obs13";   
                
                document.getElementById("notas13").appendChild(inputnota);         
                document.getElementById("notas13").appendChild(input2);
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
			if (<?php echo ($d14); ?> == 1) 
            { 
				$('#notas14 *').prop('disabled',true);
				var div = document.getElementById('notas14');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id14";
                inputnota.id = "id14";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs14";      
                input2.id = "obs14";   
                
                document.getElementById("notas14").appendChild(inputnota);         
                document.getElementById("notas14").appendChild(input2);
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}
            if (<?php echo ($d15); ?> == 1) 
            { 
				$('#notas15 *').prop('disabled',true);
				var div = document.getElementById('notas15');
				div.style.opacity = "0.5";
				div.style.filter  = 'alpha(opacity=90)'; // IE fallback
				
				var inputnota = document.createElement("input");
                inputnota.type = "hidden";
                inputnota.value = '0';
                inputnota.name = "id15";
                inputnota.id = "id15";
                
                var input2 = document.createElement("input");
                input2.type = "hidden";
                input2.value = ' ';
                input2.name = "obs15";      
                input2.id = "obs15";   
                
                document.getElementById("notas15").appendChild(inputnota);         
                document.getElementById("notas15").appendChild(input2);
				div.innerHTML = div.innerHTML + '<span class="text-danger">esta competência não é avaliada para a função/cargo do funcionário(a)</span>';
			}				
     </script>

@stop
