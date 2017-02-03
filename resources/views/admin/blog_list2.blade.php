@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Blog_list
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link rel="stylesheet" href="{{ asset('assets/vendors/tags/dist/bootstrap-tagsinput.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Blog List</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Blog</a>
                    </li>
                    <li class="active">Blog List</li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                <!--main content-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary filterable" style="overflow:auto;">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                        <i class="livicon" data-name="user" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        Blog List
                                    </h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table2">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>
                                                    <span><a href="blog_details2.html"><i class="livicon" data-name="info" data-size="21" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <span><a href="add_newblog.html"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <span><a href="#" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="blog-remove" data-size="19" data-loop="true" data-c="#ef6f6c" data-hc="#ef6f6c"></i></a>
                                                        </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>
                                                    <span><a href="blog_details2.html"><i class="livicon" data-name="info" data-size="21" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <span><a href="add_newblog.html"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <span><a href="#" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="blog-remove" data-size="19" data-loop="true" data-c="#ef6f6c" data-hc="#ef6f6c"></i></a>
                                                        </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>
                                                    <span><a href="blog_details2.html"><i class="livicon" data-name="info" data-size="21" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <span><a href="add_newblog.html"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <span><a href="#" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="blog-remove" data-size="19" data-loop="true" data-c="#ef6f6c" data-hc="#ef6f6c"></i></a>
                                                        </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>
                                                    <span><a href="blog_details2.html"><i class="livicon" data-name="info" data-size="21" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <span><a href="add_newblog.html"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#418bca" data-hc="#418bca"></i></a>
                                                        </span>
                                                    <a href="#" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="blog-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Modal for showing delete confirmation -->
                                    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="user_delete_confirm_title">
                                                Delete User
                                            </h4>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete this user? This operation is irreversible.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <a href="#" type="button" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--main content ends-->
            </section>
            <!-- content -->
        
    @stop

{{-- page level scripts --}}
@section('footer_scripts')
    
    <!--tags-->
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.js') }}" ></script>
    <script>
    $(document).ready(function() {
        $('#table2').dataTable();
    });
    </script>

    
@stop
