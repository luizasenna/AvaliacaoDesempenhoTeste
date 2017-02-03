@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Competências por Função
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Competências por Função</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Painel
            </a>
        </li>
        <li>Competências por Função</li>
        <li class="active">Disponiveis no TOTVS</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Competências por Funções Disponiveis no Momento
                </h4>
            </div>
            
            <div class="panel-body">
				<div class="bg-success paddingleft_right15">
					<p>Olá! <br/>
					
					Algumas informações:  <br/>
					 - Os campos 1 a 15 representam as competências da avaliação de desempenho; <br/>
					 - O campo cod representa o código da função no TOTVS; <br/>
					 - Quando no campo conter 0, a competência estará ativa, quando 1, a cometência estará inativa.<br/>
					</p>
				</div>
				<br/>
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
							<th>Nome do Cargo</th>
							<th>Código</th>
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>7</th>
							<th>8</th>
							<th>9</th>
							<th>10</th>
							<th>11</th>
							<th>12</th>
							<th>13</th>
							<th>14</th>
							<th>15</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($vercargos as $vercargo)
                        <tr>
							<td>{!! $vercargo->nome !!}</td>
							<td>{!! $vercargo->codcargo !!}</td>
							<td>
								@if ($vercargo->c1 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c2 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								@endif
								</td>
							<td>
								@if ($vercargo->c3 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c4 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c5 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c6 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c7 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c8 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c9 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>
								@if ($vercargo->c10 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif
							</td>
							<td>@if ($vercargo->c11 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif</td>
							<td>@if ($vercargo->c12 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif</td>
							<td>@if ($vercargo->c13 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif</td>
							<td>@if ($vercargo->c14 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif</td>
							<td>@if ($vercargo->c15 == 0)
									 <center><i class="fa fa-eye text-info" title="Visível"></i></center>
								  @else
									<center><i class="fa fa-eye-slash text-default" title="Invisível"></i></center>
 								  @endif</td>
                            <td>
                                <a href="{{ route('admin.vercargos.show', $vercargo->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="ver função"></i>
                                </a>
                                <a href="{{ route('admin.vercargos.edit', $vercargo->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="editar função"></i>
                                </a>
                                <a href="{{ route('admin.vercargos.delete', $vercargo->id) }}">
                                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="deletar função"></i>
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
