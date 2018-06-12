@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
abono
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Abonos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>abonos</li>
        <li class="active">abonos</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Detalhes do Abono {{ $abono->descricao }}
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $abono->id }}</td></tr>
                    <tr><td>Código</td><td>{{ $abono['codigo'] }}</td></tr>
          					<tr><td>Descrição</td><td>{{ $abono['descricao'] }}</td></tr>
          					<tr><td>Status</td><td>{{ $abono['status'] }}</td></tr>
          					<tr><td>Usuário</td><td>{{ $abono->usuario->first_name }}</td></tr>
          					<tr><td>Criado em</td><td>{{ date("d/m/Y", strtotime($abono['created_at'])) }}</td></tr>

                </table>
            </div>
        </div>
    </div>
</div>
@stop
