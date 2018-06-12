@extends('layouts/selecoes')

{{-- Page title --}}
@section('title')
    Seleções Pintos
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">


@stop

{{-- Page content --}}
@section('content')

<div class="container" style="min-height:500px;">
    <section class="purchas-main" >

    </section>
    <!-- Service Section Start-->
    <div class="row">
        <!-- Responsive Section Start -->
        <div class="text-center">
            <h3 class="border-primary"><span class="heading_border bg-primary">Seleções</span></h3>
        </div>
        <div class="col-md-12" style="min-height:800px;">
            <nav class="navbar navbar-inverse ">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li>Seleções Abertas</li>
                        <li>Seleções Fechadas</li>
                    </ul>
              </div>
            </nav>

        </div>




    </div>
    <!-- //Services Section End -->
</div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')




@stop
