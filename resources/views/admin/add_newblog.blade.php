@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add New Blog
@parent
@stop

{{-- page level styles --}}
@section('header_styles')    
    
	<link href="{{ asset('assets/vendors/summernote/dist/summernote.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/summernote/dist/summernote-bs3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/blog.css') }}" rel="stylesheet" type="text/css">
    
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Add new blog</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Blog</a>
                    </li>
                    <li class="active">Add new blog</li>
                </ol>
            </section>
            <!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
            <form role="form">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" placeholder="Post title here...">
                        </div>
                        <div class='box-body pad'>

                            <div id="summernote"></div>

                        </div>
                    </div>
                    <!-- /.col-sm-8 -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Post category</label>
                            <input type="text" class="form-control" placeholder="Post category">
                        </div>
                        <div class="form-group">
                            <label>Post date</label>
                            <input type="text" class="form-control datepicker" data-date-format="mm-dd-yy" placeholder="mm-dd-yy">
                        </div>
                        <div class="form-group">
                            <label>Post author</label>
                            <input type="text" class="form-control" placeholder="Post author">
                        </div>
                        <div class="form-group">
                            <label>Featured image</label>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <span class="btn btn-primary btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" />
                                            </span>
                                <span class="fileupload-preview"></span>
                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Save and post</button>
                            <button class="btn btn-danger">Discard</button>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                </div>
                <!-- /.row -->
            </form>
        </div>
    </div>
    <!--main content ends-->
</section>
            <!-- content -->
        
    @stop

{{-- page level scripts --}}
@section('footer_scripts')
    
    <!--new blog-->
    <script type="text/javascript" src="{{ asset('assets/vendors/summernote/dist/summernote.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/add_newblog.js') }}" ></script>

@stop
