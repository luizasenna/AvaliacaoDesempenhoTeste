@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Blog Details
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css-->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/blog.css') }}" />
    
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Blog Details</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="12" data-c="#000" data-loop="true"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Blog</a>
                    </li>
                    <li class="active">Blog Details</li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                <!--main content-->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-full-width-right">
                        <div class="blog-detail-image">
                            <img data-src="holder.js/1900x380/#00bc8c:#fff" class="img-responsive" alt="Image">
                        </div>
                        <!-- /.blog-detail-image -->
                        <div class="the-box no-border blog-detail-content">
                            <p>
                                <span class="label label-danger square">July 11, 2014 @05:10:45 PM</span>
                            </p>
                            <p>
                                hi,
                                <br /> this is a new blog post
                            </p>

                            <p>
                                <span class="label label-info square">LEAVE A COMMENT</span>
                            </p>
                            <form role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" placeholder="Your name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control input-lg" placeholder="Your email address">
                                </div>
                                <div class="form-group">
                                    <input type="url" class="form-control input-lg" placeholder="Your website">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control input-lg no-resize" style="height: 200px" placeholder="Your comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-md">
                                        <i class="fa fa-comment"></i> Submit comment
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /the.box .no-border -->
                    </div>
                    <!-- /.col-sm-9 -->

                    <!-- /.col-sm-3 -->
                </div>
                <!--main content ends-->
            </section>
            <!-- /.content -->
        
    @stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
