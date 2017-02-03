@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Competências por Cargos
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Competências por Cargos </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Painel
            </a>
        </li>
        <li>Ver competências por cargos</li>
        <li class="active">Cargos disponíveis no TOTVS</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                   Detalhes
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>ID</td><td>{{ $vercargo->id }}</td></tr>
   					<tr><td>Codigo no TOTVS</td><td>{{ $vercargo['codcargo'] }}</td></tr>
					<tr><td>Descrição do Cargo</td><td>{{ $vercargo['nome'] }}</td></tr>
					<tr><td>01 - Aprendizagem e Adaptação </td><td>{{ $vercargo['c1'] }}</td></tr>
					<tr><td>02 - Apresentação Pessoal </td><td>{{ $vercargo['c2'] }}</td></tr>
					<tr><td>03 - Assiduidade </td><td>{{ $vercargo['c3'] }}</td></tr>
					<tr><td>04 - Comunicação</td><td>{{ $vercargo['c4'] }}</td></tr>
					<tr><td>05 - Disciplina e Respeito</td><td>{{ $vercargo['c5'] }}</td></tr>
					<tr><td>06 - Estabilidade Emocional</td><td>{{ $vercargo['c6'] }}</td></tr>
					<tr><td>07 - Hábitos de Segurança, Higiene e Zelo</td><td>{{ $vercargo['c7'] }}</td></tr>
					<tr><td>08 - Iniciativa e Criatividade</td><td>{{ $vercargo['c8'] }}</td></tr>
					<tr><td>09 - Interesse, Dedicação e Sigilo</td><td>{{ $vercargo['c9'] }}</td></tr>
					<tr><td>10 - Organização</td><td>{{ $vercargo['c10'] }}</td></tr>
					<tr><td>11 - Pontualidade</td><td>{{ $vercargo['c11'] }}</td></tr>
					<tr><td>12 - Produtividade</td><td>{{ $vercargo['c12'] }}</td></tr>
					<tr><td>13 - Qualidade</td><td>{{ $vercargo['c13'] }}</td></tr>
					<tr><td>14 - Relacionamento Pessoal e Colaboração</td><td>{{ $vercargo['c14'] }}</td></tr>
					<tr><td>15 - Administração</td><td>{{ $vercargo['c15'] }}</td></tr>
					<tr><td>Criado em </td><td>{{ $vercargo['created_at'] }}</td></tr>
					<tr><td>Atualizado em </td><td>{{ $vercargo['updated_at'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop
