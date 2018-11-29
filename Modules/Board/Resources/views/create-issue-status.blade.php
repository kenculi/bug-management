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
<form method="POST" action="{{ url('/board/create-status') }}">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close btn-cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">
            <span class="projTitle">Tạo trạng thái</span>
        </h4>
    </div>
    <div class="box-body form-scrolling">
        <div class="form-group">
            <label for="projectId">Dự án <span class="requiredStar"></span></label>
            <select class="form-control" name="projectId" id="projectId">
                @foreach($projects as $project)
                @php
                    $selected = $project->id == $projectId ? "selected" : "";
                @endphp
                    <option {{ $selected }} value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('projectId') }}</span>
        </div>
        <div class="form-group">
            <label for="name">Tên trạng thái <span class="requiredStar"></span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Tên trạng thái"  value="{{ old('name') }}">
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
        <div class="form-group">
            <label for="description">Mô tả trạng thái</span></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Mô tả trạng thái"  value="{{ old('description') }}">
            <span class="text-danger">{{ $errors->first('description') }}</span>
        </div>
    </div>
    <div class="box-footer text-center">
        <button type="button" class="btn btn-cancel btn-default for-cancel">Hủy</button>
        <button type="submit" class="btn btn-primary for-save">Tạo mới</button>
    </div>
</form>
@stop

@section('script')
<script>

</script>
@stop