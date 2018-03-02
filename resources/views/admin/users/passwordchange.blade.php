@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Modificar senha do usuário
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/x-editable/bootstrap-editable.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Perfil do Usuário</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Painel
                </a>
            </li>
            <li>
                <a href="#">Uusários</a>
            </li>
            <li class="active">Modificar senha do Usuário</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                   
                    <div id="tab1" class="">
                        <div class="row">
                            <div class="col-md-12 pd-top">
							
                                <form class="form-horizontal">
                                    <div class="form-body">
										<div class="col-md-3"><b>Usuário:</b></div>
										<div class="col-md-9">
										<p> {{$user->first_name}}{{$user->last_name}}</p>
									</div>
                                        <div class="form-group">
                                            <label for="inputpassword" class="col-md-3 control-label">
                                                Senha
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                            </span>
                                                    <input type="password" id="password" placeholder="Senha"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputnumber" class="col-md-3 control-label">
                                                Confirme a senha
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                            </span>
                                                    <input type="password" id="password-confirm" placeholder="Senha"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-primary" id="change-password">Enviar
                                            </button>
                                            &nbsp;
                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                            &nbsp;
                                            <input type="reset" class="btn btn-default hidden-xs" value="Limpar Campos"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#change-password').click(function (e) {
                e.preventDefault();
                var check = false;
                var sendData = '_token={{ Session::getToken() }}' + '&password=' + $('#password').val() + '&password-confirm=' + $('#password-confirm').val();
                if ($('#password').val() === $('#password-confirm').val()) {
                    check = true;
                }
                if (check) {
                    $.ajax({
                        url: 'passchange',
                        type: "get",
                        data: sendData,
                        success: function (data) {
                            alert('senha resetada com sucesso');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert('erro no reset da senha');
                        }
                    });
                } else {
                    alert('as duas senhas inseridas não conferem');
                }
            });
        });
    </script>
@stop
