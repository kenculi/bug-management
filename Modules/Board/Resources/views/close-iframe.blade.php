@extends('iframe')
@section('content')
<button type="button" class="close btn-cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h1 id="display-middle-cell">{{ isset($message) ? $message : "" }}</h1>
@stop
@section('script')
    <script>
        setTimeout(function() {
            window.parent.location.reload(false);
        }, 0);
    </script>
@stop