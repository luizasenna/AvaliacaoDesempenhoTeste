<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>
    	@section('title')
        | Pintos Ltda
        @show
    </title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/skins/hoki_skin.css') }}">
     <link href="{{ asset('assets/css/pages/alertmessage.css') }}" rel="stylesheet"  type="text/css"/>
    <!--end of global css-->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body>
    <!-- Header Start -->
    <header>
        <!-- Icon Section Start -->
        <div class="icon-section">
            <div class="container">
                <ul class="list-inline">



                    <li class="pull-right">
                        <ul class="list-inline icon-position">

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- //Icon Section End -->
        <!-- Nav bar Start -->
        <nav class="navbar navbar-default container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span><a href="#">_<i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true" data-c="#757b87" data-hc="#ccc"></i>
                    </a></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/pintos-selecoes.png') }}" alt="logo" class="logo_position">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
               <ul class="nav navbar-nav navbar-middle navbar-default">
                 {{--Visitantes podem ver--}}
                 @if(Sentinel::guest())
                     <li><a href="{{ URL::to('selecoes/') }}">Seleções Abertas</a></li>
                     <li><a href="{{ URL::to('selecoes/andamento') }}">Em Andamento</a></li>
                     <li><a href="{{ URL::to('selecoes/concluidas') }}">Concluídas</a></li>
                     <li><a href="http://pintos.com.br">Voltar ao Site</a></li>
               </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li class="text-danger"><a class="text-danger" href="{{ URL::to('selecoes/entrar') }}">
                    <button type="button" class="btn btn-success">Entrar / Atualizar Currículo</button>
                    </a></li>
                        <li><a href="{{ URL::to('selecoes/cadastrar') }}">
                          <button type="button" class="btn btn-info">Cadastrar</button>
                          </a></li>
                    @else
                        <li {{ (Request::is('perfil-profissional') ? 'class=active' : '') }}><a href="{{ URL::to('selecoes/perfil-profissional') }}">Meu Currículo</a>
                        </li>
                        <li><a href="{{ URL::to('logout') }}">Sair</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- Nav bar End -->
    </header>
    <!-- //Header End -->

    <!-- slider / breadcrumbs section -->
    @yield('top')

    <!-- Notifications -->
    <!--@include('layouts/notification')	-->

    <!-- Content -->
    @yield('content')

    <!-- Footer Section Start -->
    <footer>
        <div class="container footer-text">


        </div>
    </footer>
    <!-- //Footer Section End -->

    	<!-- Analytics Intranet RH-->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-46066108-3', 'auto');
		  ga('send', 'pageview');

		</script>
    	<!-- Analytics Intranet RH-->

    <div class="copyright">
        <div class="container">
        <p>pintos.com.br - Todos os direitos reservados.</p>
        </div>
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Subir para o topo" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>
    <!--global js starts-->
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('assets/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/js/livicons-1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/josh_frontend.js') }}"></script>
    <!--global js end-->
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
</body>

</html>
