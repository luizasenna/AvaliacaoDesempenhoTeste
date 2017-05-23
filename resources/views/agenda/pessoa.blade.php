@extends('layouts/default')

{{-- Page title --}}
@section('title')
Agenda de Contatos
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
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Home
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="/agenda/">Agenda de Contatos</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="home" data-size="20" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i> Agenda de Contatos
            </div>
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')
    <!-- Aba de Título -->
    <div class="text-center">
                <h3 class="border-warning"><span class="heading_border bg-warning"> 
				<i class="livicon icon3" data-name="home" data-size="30" data-loop="true" data-c="#ffffff" data-hc="red"></i>
				Agenda de Contatos</span></h3>
        </div>	<center>
        <div class="col-md-4 pull-center">
			@if (session('status'))
		<div id="alert_msg" class="alert alert-info alert-dismissable">
			<strong>{{ session('status') }}</strong>
		</div>
		@endif
	</div></center>
    
    
    <div class="container" style="min-height:800px;">
        <!--Content Section Start -->
		<div class="col-md-12">
			
			<div class="col-md-2"></div>
			<div class="col-md-8 bg-default rounded" style="padding: 10px;">
				<div>
                @foreach($pessoa as $p)
				<div class="col-md-10"><h3> {{$p->nome}}</h3></div>
                @if($p->idtipo==1)
                    <div class="bg-primary rounded col-md-2" >
                        {{ $p->tipo->nome }}
                    </div>
                @endif 
                @if($p->idtipo==2)
                    <div class="bg-success rounded col-md-2" style="font-size: 12px;">
                        {{ $p->tipo->nome }}
                    </div>
                @endif 
                @if($p->idtipo==3)
                    <div class="bg-info rounded col-md-2" style="font-size: 10px;">
                        {{ $p->tipo->nome }}
                    </div>
                @endif 
                @if($p->idtipo==4)
                    <div class="bg-danger rounded col-md-2" >
                        {{ $p->tipo->nome }}
                    </div>
                @endif 
                <table class="table table-stripped">
                    <tr>
                        <td><b>Apelido:</b> {{$p->apelido}}</td>
                        <td>
                            <b>Empresa:</b> @if($p->idempresa){{$p->empresa->nome}}@else --- @endif
                        </td>
                        <td><b>@if($p->idtipo==1)Chapa: @if($p->chapatotvs){{$p->chapatotvs}}@else --- @endif @endif</b></td>
                        <td><b>@if($p->idtipo==1)Cod Pessoa TOTVS: @if($p->idpessoatotvs){{$p->idpessoatotvs}}@else --- @endif @endif</b></td>
                    </tr>
                </table>

                @endforeach    
                 
                 <h4 class="text-primary">Telefones</h4> 
                 
                    <table class="table table-stripped">
                        @if(isset($telefones))
                          
                            <tr>
                                <th>Tipo</th>
                                <th>Descrição</th>
                                <th>DDD</th>
                                <th>Número</th>
                                <th>Status</th>
                                <th>Observações</th>
                            </tr>
                            @foreach($telefones as $t)    
                                <tr>
                                   <td>{{$t->tipo->descricao}}</td> 
                                   <td>{{$t->descricao}}</td>
                                   <td>{{$t->ddd}}</td>
                                   <td>{{$t->numero}}</td>
                                   <td>@if($t->status==0)Atual @else Anterior @endif</td>
                                   <td>{{$t->observacao}}</td>
                                </tr>
                            @endforeach
                        @else    
                            Nenhum telefone cadastrado ainda
                        @endif
                    </table>
                    <a href="" class="btn btn-primary pull-right" style="color: #fff;">Insere Novo Telefone</a>
                 <h4 class="text-primary">Emails</h4> 
                 
                    <table class="table table-stripped">
                        <tr>
                            <th>Descrição</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Observações</th>
                        </tr>
                        @foreach($emails as $e)    
                            <tr>
                               <td>{{$e->descricao}}</td>
                               <td>{{$e->email}}</td>
                               <td>@if($t->status==0)Atual @else Anterior @endif</td>
                               <td>{{$t->observacao}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="">Insere Novo EmailS</a>

				</div>

			</div>
			<div class="col-md-2"></div>
			
            

		</div>
	</div>	
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/pages/general.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/advfeatures.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    //v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    //v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id( tel ){
    return document.getElementById( tel );
}
window.onload = function(){
    id('telefone').onkeyup = function(){
        mascara( this, mtel );
    }
}
</script>


@stop
