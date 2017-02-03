@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
veravaliacao
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Veravaliacaos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Visualização de Avaliação</li>
        <li class="active">Configuração da Avaliação</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Detalhes da Avaliação id {{ $veravaliacao->id }}
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $veravaliacao->id }}</td></tr>
					<tr><td>codigo da avaliacao no totvs</td><td>{{ $veravaliacao['codigoavaliacao'] }}</td></tr>
					<tr><td>Nome da Avaliação</td><td>{{$veravaliacao->avaliacao ? $veravaliacao->avaliacao->NOME : '--' }}</td></tr>
					<tr><td>status do lider</td><td>{{ $veravaliacao['statuslider'] }}</td></tr>
					<tr><td>status do admin</td><td>{{ $veravaliacao['statusadmin'] }}</td></tr>
					<tr><td>status da diretoria</td><td>{{ $veravaliacao['statusdiretoria'] }}</td></tr>
					<tr><td>observações</td><td>{{ $veravaliacao['obs'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop
