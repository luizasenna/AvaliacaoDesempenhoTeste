
@if (session('status'))
    <div id="alert_msg" class="alert alert-info alert-dismissable">
        <strong>{{ session('status') }}</strong>
    </div>
@endif

