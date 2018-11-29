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
<form method="POST" action="{{ url('/board/create-issue') }}">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close btn-cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">
            <span class="projTitle">Tạo lỗi</span>
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
            <label for="summary">Tóm tắt <span class="requiredStar"></span></label>
            <input type="text" class="form-control" name="summary" id="summary" placeholder="Tóm tắt"  value="{{ old('summary') }}">
            <span class="text-danger">{{ $errors->first('summary') }}</span>
        </div>

        <div class="form-group">
            <label for="priorityId">Độ ưu tiên <span class="requiredStar"></span></label>
            <select class="form-control" name="priorityId" id="priorityId">
                @foreach($priorities as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('priorityId') }}</span>
        </div>
        <div class="form-group">
            <label class="control-label">Ngày kết thúc</label>
                <input type="text" name="dueDate" class="form-control" value="{{ old('dueDate') }}" placeholder="Ngày kết thúc">
                <span>(DD-MM-YYYY)</span>
        </div>
        <div class="form-group">
            <label for="linkedIssueType">Loại liên kết lỗi</label>
            <select class="form-control" name="linkedIssueType" id="linkedIssueType">
                <option value="0">-------</option>
                @foreach($linkedIssueTypes as $linkedIssueType)
                    <option value="{{ $linkedIssueType->id }}">{{ $linkedIssueType->link_name }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('linkedIssueType') }}</span>
        </div>
        <div class="form-group">
            <label for="issueId">Lỗi</label>
            <select class="form-control" name="issueId" id="issueId">
                <option value="0">-------</option>
                @foreach($issues as $issue)
                    <option value="{{ $issue->id }}">{{ $issue->summary }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('issueId') }}</span>
        </div>
        <div class="form-group">
            <label for="assignee">Người thực hiện</label>
            <select class="form-control" name="assignee" id="assignee">
                <option value="0">Không chỉ định</option>
                @foreach($assignees as $assignee)
                    <option value="{{ $assignee->getUserInvited()->id }}">{{ $assignee->getUserInvited()->full_name }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('assignee') }}</span>
        </div>
        <div class="form-group">
            <a><label onClick="assignme({{ Auth::user()->id }})">Chỉ định tôi</label></a>
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
    $('input[name="dueDate"]').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '0',
        autoclose: true
    })

    function assignme(userId) {
        $('select[name="assignee"]').find("option[value="+userId+"]").attr("selected", true);
        $('select[name="assignee"]').refresh();
    }
</script>
@stop