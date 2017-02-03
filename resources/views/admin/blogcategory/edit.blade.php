@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('groups/title.edit')
@parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>
        @lang('groups/title.edit')
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li>@lang('groups/title.groups')</li>
        <li class="active">@lang('groups/title.edit')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="wrench" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('blogcategory/title.edit')
                    </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($blogcategory, array('url' => URL::to('admin/blogcategory') . '/' . $blogcategory->id.'/edit', 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true)) !!}
                    <div class="form-group {{ $errors->first('title', 'has-error') }}">
                            <label for="title" class="col-sm-2 control-label">
                                @lang('blogcategory/form.name')
                            </label>
                            <div class="col-sm-5">
                                {!! Form::text('title', null, array('class' => 'form-control', 'placeholder'=>trans('blogcategory/form.categoryname'))) !!}
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ route('groups') }}">
                                    @lang('button.cancel')
                                </a>
                                <button type="submit" class="btn btn-success">
                                    @lang('button.update')
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>

@stop