@foreach (['success', 'info', 'warning', 'danger'] as $msg)
@if (session()->has($msg))
        <div id="global-flash-message" class="alert alert-{{ $msg }} alert-dismissible" role="alert">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&times;</span></button>
            {{ session()->get($msg) }}
        </div>
@endif
@endforeach
