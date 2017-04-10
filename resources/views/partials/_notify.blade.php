@if(Session::has('state'))
    <div class="panel panel-success" data-hide>
        <div class="panel-heading">{{ Session::get('state') }}</div>
    </div>
@endif

@if(Session::has('error'))
    <div class="panel panel-danger" data-hide>
        <div class="panel-heading">{{ Session::get('error') }}</div>
    </div>
@endif