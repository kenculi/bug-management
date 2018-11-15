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
</style>
@stop
@section('content')
<form method="POST" action="">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close btn-cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">
            <span class="projTitle">Cập nhật dự án</span>
        </h4>
    </div>
    <div class="box-body form-scrolling">
        <div class="form-group">
            <label for="projectName">Tên dự án</label>
            <input type="text" class="form-control" name="projectName" id="projectName" placeholder="Tên dự án"  value="{{ $project->name }}">
            <span class="text-danger">{{ $errors->first('projectName') }}</span>
        </div>
    </div>
    <div class="box-footer text-center">
        <button type="button" class="btn btn-cancel btn-default for-cancel">Hủy</button>
        <button type="submit" class="btn btn-primary for-save">Cập nhật</button>
    </div>
</form>
@stop

@section('script')
@stop