@extends('master')
@section('title', 'Mời dự án')
@section('page-header', 'Mời dự án')
@section('content')
    <div class="row">
        <h3 align="center">
            @if(is_numeric($message))
                @if($message == 2) {{-- Accepted --}}
                    Bạn đã tham gia dự án.
                @else {{-- Denied --}}
                    Bạn đã từ chối tham gia dự án.
                @endif
            @else
                {{ $message }}
            @endif
        </h3>
    </div>
@stop

@section('script')
@stop