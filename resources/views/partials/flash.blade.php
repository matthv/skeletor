@foreach (['success', 'error', 'info', 'warning'] as $msg)
    @if(Session::has($msg))
        <div class="alert alert-{{ $msg }} mb-0">
            {{ Session::get($msg) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach