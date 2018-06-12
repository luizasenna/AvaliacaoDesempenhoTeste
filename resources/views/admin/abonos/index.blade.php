@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
abonos List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Abonos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Abonos</li>
        <li class="active">Todos os Abonos</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Lista de Abonos Considerados na Assiduidade
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.abonos.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Código</th>
              							<th>Descrição</th>
              							<th>Status</th>
              							<th>Usuário</th>
              							<th>Criado em</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($abonos as $abono)
                        <tr>
                            <td>{!! $abono->id !!}</td>
                            <td>{!! $abono->codigo !!}</td>
              							<td>{!! $abono->descricao !!}</td>
              							<td>@if($abono->status==0) Ativo @else Inativo @endif</td>
              							<td>{!! $abono->usuario->first_name !!} {!!$abono->usuario->last_name !!}</td>
              							<td>@if(! is_null($abono->created_at)) {!! date("d/m/Y",strtotime($abono->created_at)) !!}@endif</td>
                            <td>
                                <a href="{{ route('admin.abonos.show', $abono->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view abono"></i>
                                </a>
                                <a href="{{ route('admin.abonos.edit', $abono->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit abono"></i>
                                </a>
                                <a href="{{ route('admin.abonos.confirm-delete', $abono->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete abono"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop
