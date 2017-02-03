@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New vercargo
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Vercargos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>vercargos</li>
        <li class="active">Create New vercargo</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new vercargo
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => 'admin/vercargos']) !!}

                    <div class="form-group">
                        {!! Form::label('id', 'Id: ') !!}
                        {!! Form::text('id', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('codcargo', 'Codcargo: ') !!}
                        {!! Form::text('codcargo', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('nome', 'Nome: ') !!}
                        {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c1', 'C1: ') !!}
                        {!! Form::text('c1', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c2', 'C2: ') !!}
                        {!! Form::text('c2', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c3', 'C3: ') !!}
                        {!! Form::text('c3', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c4', 'C4: ') !!}
                        {!! Form::text('c4', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c5', 'C5: ') !!}
                        {!! Form::text('c5', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c6', 'C6: ') !!}
                        {!! Form::text('c6', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c7', 'C7: ') !!}
                        {!! Form::text('c7', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c8', 'C8: ') !!}
                        {!! Form::text('c8', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c9', 'C9: ') !!}
                        {!! Form::text('c9', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c10', 'C10: ') !!}
                        {!! Form::text('c10', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c11', 'C11: ') !!}
                        {!! Form::text('c11', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c12', 'C12: ') !!}
                        {!! Form::text('c12', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c12', 'C12: ') !!}
                        {!! Form::text('c12', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c13', 'C13: ') !!}
                        {!! Form::text('c13', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c14', 'C14: ') !!}
                        {!! Form::text('c14', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('c15', 'C15: ') !!}
                        {!! Form::text('c15', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('created_at', 'Created At: ') !!}
                        {!! Form::text('created_at', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('updated_at', 'Updated At: ') !!}
                        {!! Form::text('updated_at', null, ['class' => 'form-control']) !!}
                    </div>

					

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.vercargos.index') }}">
                                @lang('button.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
                                @lang('button.save')
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