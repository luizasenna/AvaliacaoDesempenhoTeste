@extends('emails/layouts/default')

@section('content')
<p>Ol&aacute; {!! $user->first_name !!} {!! $user->last_name !!},</p>

<p>Clique no link abaixo para atualizar sua senha:</p>

<p><a href="{!! $forgotPasswordUrl !!}">{!! $forgotPasswordUrl !!}</a></p>

<p>Atenciosamente,</p>

<p>Intranet Recursos Humanos</p>
@stop
