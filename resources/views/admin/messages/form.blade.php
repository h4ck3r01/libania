@if(Session::has('created') || Session::has('updated') || Session::has('deleted'))

    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @if(Session::has('created'))
            {{session('created')}}
        @elseif(Session::has('updated'))
            {{session('updated')}}
        @else
            {{session('deleted')}}
        @endif
    </div>
@endif