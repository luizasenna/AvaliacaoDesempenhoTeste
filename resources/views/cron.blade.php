@extends('layouts/default')

{{-- Page title --}}
@section('title')
Cron de tarefas
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
   
    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
@stop


{{-- Page content --}}
@section('content')

<? shell_exec(tar -cvzf IntranetRH-backup-$(date +%Y%m%d).tar.gz *); ?>

@stop

{{-- page level scripts --}}
@section('footer_scripts')


@stop
