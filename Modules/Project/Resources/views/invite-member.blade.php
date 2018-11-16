@extends('iframe')
@section('cssloader')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
    .flex-display {
        display: flex;
    }
    .flex-center {
        display: flex;
        align-items: center;
    }

    .flex-right {
        justify-content: flex-end;
    }

    .border-top {
        border-top: 1px solid #d2d6de;
    }
    .border-bot {
        border-bottom: 1px solid #d2d6de;
    }
</style>
@stop
@section('content')
<form method="POST" action="">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close btn-cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">
            <span class="projTitle">Mời thành viên</span>
        </h4>
    </div>
    <div class="box-body form-scrolling">
        <div class="form-group">
            <label for="emailInvite">Email/ Tên <span class="requiredStar"></span></label>
            <select class="form-control" multiple="multiple" name="emailInvite[]" id="emailInvite" placeholder="Nhập email hoặc tên thành viên">
                @foreach($userNotBeInvited as $member)
                @php
                    $arrIds = old("emailInvite") ?: [];
                    $selected = in_array($member->id, $arrIds) ? "selected" : "";
                @endphp
                    <option {{ $selected }} value="{{ $member->id }}">{{ $member->email }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('emailInvite') }}</span>
        </div>
        <div class="row">
            <div class="col-md-10 col-xs-10">
                @if(!empty($acceptedInvite))
                {{ $acceptedInvite }}
                @endif
            </div>
            <div class="col-md-2 col-xs-2"><span class="label label-success">Chấp nhận</span></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-10 col-xs-10">
                @if(!empty($pendingInvite))
                {{ $pendingInvite }}
                @endif
            </div>
            <div class="col-md-2 col-xs-2"><span class="label label-warning">Đang đợi</span></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-10 col-xs-10">
                @if(!empty($deniedInvite))
                {{ $deniedInvite }}
                @endif
            </div>
            <div class="col-md-2 col-xs-2"><span class="label label-danger">Từ chối</span></div>
        </div>
    </div>
    <div class="box-footer text-center">
        <button type="button" class="btn btn-cancel btn-default for-cancel">Hủy</button>
        <button type="submit" class="btn btn-primary for-save">Mời</button>
    </div>
</form>
@stop

@section('script')
    <script type="text/javascript" src="{{ asset('js/invite.js') }}"></script>
@stop