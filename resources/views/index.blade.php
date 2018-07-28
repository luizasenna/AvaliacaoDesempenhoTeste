@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.theme.css') }}">
    <!--end of page level css-->
@stop



{{-- content --}}
@section('content')
    <div class="container" style="min-height:500px;">
        <section class="purchas-main" >

        </section>
        <!-- Service Section Start-->
        <div class="row">
            <!-- Responsive Section Start -->
            <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary">Recursos Humanos</span></h3>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="box">
                    <div class="box-icon">
                       <a href="avaliacao/"> <i class="livicon icon" data-name="tasks" data-size="55" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i></a>
                    </div>
                    <div class="info">
                        <a href="avaliacao/"><h3 class="success text-center">Desempenho</h3></a>
                        <p>Envie e acompanhe as Avaliações de Desempenho dos seus funcionários</p>
                        <div class="text-right primary"><a href="avaliacao/">Entrar</a>
                        </div>
                    </div>
                </div>
            </div>
             <!-- //Easy to Use Section End -->
            <!-- Clean Design Section Start -->
            <div class="col-sm-6 col-md-3">
                <div class="box">
                    <div class="box-icon box-icon2">
                        <i class="livicon icon1" data-name="home" data-size="55" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i>
                    </div>
                    <div class="info">
                        <h3 class="warning text-center">Agenda</h3>
                        <p>Veja os contatos dos funcionários e fornecedores.</p>
                        <div class="text-right primary"><a href="agenda/">Entrar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Responsive Section End -->
            <!-- Easy to Use Section Start -->
            <div class="col-sm-6 col-md-3">
                <!-- Box Start -->
                <div class="box">
                    <div class="box-icon box-icon1">
                        <i class="livicon icon1" data-name="alarm" data-size="55" data-loop="true" data-c="#418bca" data-hc="#418bca"></i>
                    </div>
                    <div class="info">
                        <h3 class="primary text-center">Ponto Eletrônico</h3>
                        <p>Envie e acompanhe as Justificativas de Ponto dos seus funcionários.</p>
                        <div class="text-right">
                           <span class="danger"> <a href="https://app.smartsheet.com/b/form?EQBCT=41420567586445f7a76f0bdbe10adf5b">Horas Extras</a> </span> |
                            <span class="danger"> <a href="https://app.smartsheet.com/b/form?EQBCT=645aa945b8084e24ad7259b56f720526">Atrasos</a> </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- //Clean Design Section End -->
            <!-- 20+ Page Section Start -->
            <div class="col-sm-6 col-md-3">
                <div class="box">
                    <div class="box-icon box-icon3">
                        <i class="livicon icon1" data-name="gears" data-size="55" data-loop="true" data-c="#FFD43C" data-hc="#FFD43C"></i>
                    </div>
                    <div class="info">
                        <h3 class="yellow text-center">Serviços</h3>
                        <p>Solicite serviços ao RH para seus funcionarios</p>
                        <div class="text-right primary"><a href="https://docs.google.com/a/pintos.com.br/forms/d/1D1yJjAD_QfMKEh6xEnCWtwjb55kggmiLaiS6KZPQjds/viewform">Entrar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //20+ Page Section End -->
        </div>
        <!-- //Services Section End -->
    </div>

    <!-- Accordions Section End -->

        <div class="row">

            <div class="col-md-6 col-sm-12">
                <!-- Tabbable-Panel Start -->
                <div class="tabbable-panel">
                    <!-- Tabbablw-line Start -->
                    <div class="tabbable-line">
                        <!-- Nav Nav-tabs Start -->

                        <!-- //Nav Nav-tabs End -->
                        <!-- Tab-content Start -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                <div class="media">
                                    <div class="media-left tab col-sm-12">
                                      <h3 class="text-center primary" style="line-height:middle;"><i class="livicon" data-name="gift" data-size="30" data-loop="true" data-c="#418bca" data-hc="#418bca"></i>
                                      Aniversariantes do Mês no seu setor</h3>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab_default_2">
                                <div class="media">
                                    <div class="media-left media-middle tab col-sm-12">
                                        <a href="#">
                                            <img class="media-object img-responsive" src="{{ asset('assets/images/authors/img2.jpg') }}" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <p>
                                    Branding iteration conversion market sales advisor holy grail entrepreneur backing. Gen-z non-disclosure agreement holy grail business-to-consumer disruptive deployment marketing channels seed money seed round ramen pivot social proof. Venture creative metrics focus A/B testing crowdfunding. IPhone scrum project user experience freemium interaction design long tail stealth ownership hackathon crowdfunding investor.
                                </p>
                            </div>
                            <div class="tab-pane" id="tab_default_3">
                                <div class="media">
                                    <div class="media-left media-middle tab col-sm-12">
                                        <a href="#">
                                            <img class="media-object img-responsive" src="{{ asset('assets/images/authors/img3.jpg') }}" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <p>
                                     Beta analytics startup direct mailing leverage learning curve www.discoverartisans.com business-to-consumer. IPad metrics channels pivot deployment business plan android burn rate hackathon vesting period research & development launch party user experience. Seed round freemium value proposition learning curve series A financing funding research & development crowdsource.
                                </p>
                            </div>
                            <div class="tab-pane" id="tab_default_4">
                                <div class="media">
                                    <div class="media-left media-middle tab col-sm-12">
                                        <a href="#">
                                            <img class="media-object img-responsive" src="{{ asset('assets/images/authors/img4.jpg') }}" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <p>
                                    Paradigm shift twitter pitch research & development venture. Startup partnership www.discoverartisans.com supply chain crowdsource hackathon metrics paradigm shift interaction design influencer holy grail first mover advantage ramen validation. User experience founders burn rate learning curve infographic leverage gen-z supply chain first mover advantage.
                                </p>
                            </div>
                        </div>
                        <!-- Tab-content End -->
                    </div>
                    <!-- //Tabbablw-line End -->
                </div>
                <!-- Tabbable_panel End -->
            </div>
            <div class="col-md-6 col-sm-12">
                <!-- Panel-group Start -->
                <div class="panel-group" id="accordion">
                    <!-- Panel Panel-default Start -->
                    <div class="panel panel-default">
                        <!-- Panel-heading Start -->
                        <div class="panel-heading text_bg">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <span class=" glyphicon glyphicon-plus success"></span>
                                <span class="success">Perguntas e Dúvidas Mais Frequentes</span></a>
                            </h4>
                        </div>
                        <!-- //Panel-heading End -->
                        <!-- Collapseone Start -->
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>1 - Como Delegar uma AD? </p>
                                <p>2 - Como ver notas de alguém que não é da minha equipe?</p>
                                <p>3 - Como identificar para quem delegar?</p>
                                <p>4 - Como ver nota que foi feita?</p>
                                <p>5 - Como ver a própria equipe?</p>

                            </div>
                        </div>
                        <!-- Collapseone End -->
                    </div>
                    <!-- //Panel Panel-default End -->
                    <div class="panel panel-default">
                        <div class="panel-heading text_bg">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <span class=" glyphicon glyphicon-plus success"></span>
                                <span class="success">Fale com o Recursos Humanos</span>
                            </a>
                        </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p style="vertical-align: middle;">
									<i class="livicon" data-name="cellphone" data-size="25" data-loop="true" data-c="#418bca" data-hc="#418bca"></i>
                                    Telefone: (86) 2107-4000 <br/>
                                </p>

									<h4 style="vertical-align: middle;"><i class="livicon" data-name="mail" data-size="25" data-loop="true" data-c="#418bca" data-hc="#418bca"></i>
									Emails: </h4>
									<p>
                                    Francisca: franciscarocha@pintos.com.br<br/>
                                    Angélica: angelica@pintos.com.br<br/>
                                    Auricélia: auricelia@pintos.com.br<br/>
                                    Genária: genaria@pintos.com.br<br/>
                                    Islane / Mariana: apoiorh@pintos.com.br<br/>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading text_bg">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <span class=" glyphicon glyphicon-plus success"></span>
                                <span class="success">Problemas com a Plataforma?</span></a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>
                                    Fale com a Luiza no luiza@pintos.com.br ou pelo telefone (86) 2107-4008. =) <br>
                                    Versão 2.0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //Panle-group End -->
            </div>
        </div>
        <!-- //Accordions Section End -->


    <!-- //Container End -->
@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl.carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <!--page level js ends-->

@stop
