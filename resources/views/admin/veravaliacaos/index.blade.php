@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
veravaliacaos List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Visualização de Avaliações</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Visualização de Avaliações</li>
        <li class="active">todas</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Lista de Avaliações a serem visualizadas
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.veravaliacaos.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID Intranet</th>
                            <th>ID RM</th>
                            <th>Descrição</th>
							<th>Status lider</th>
							<th>Status admin</th>
							<th>Status diretoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($veravaliacaos as $veravaliacao)
                        <tr>
                            <td>{!! $veravaliacao->id !!}</td>
                            <td>{!! $veravaliacao->codigoavaliacao !!}</td>
                            <td>{{$veravaliacao->avaliacao ? $veravaliacao->avaliacao->NOME : '--' }}</td>
							<td>
								  @if ($veravaliacao->statuslider == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif </td>
							<td>
								  @if ($veravaliacao->statusadmin == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif </td>
							</td>
							<td>
								@if ($veravaliacao->statusdiretoria == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
                            <td>
                                <a href="{{ route('admin.veravaliacaos.show', $veravaliacao->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view veravaliacao"></i>
                                </a>
                                <a href="{{ route('admin.veravaliacaos.edit', $veravaliacao->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit veravaliacao"></i>
                                </a>
                                <a href="{{ route('admin.veravaliacaos.confirm-delete', $veravaliacao->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete veravaliacao"></i>
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
