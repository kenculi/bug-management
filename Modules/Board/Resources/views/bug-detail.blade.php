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
<div class="modal-header">
    <button type="button" class="close btn-cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <button type="button" class="close dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="padding-right-10">...</span></button>
    <h4 class="modal-title" id="myModalLabel">
        <span class="projTitle"><a href="/browse/{{ $bugDetail->id }}"> {{ !empty($bugDetail) ? $firstLetter . $bugDetail->id : "" }}</a></span>
    </h4>
</div>
<div class="box-body form-scrolling bug-detail">
    {{ csrf_field() }}
    <div class="row">
        @if (!empty($bugDetail))
        <div class="col-md-7 col-xs-7">
            <h3>{{ $bugDetail->summary }}</h3>
            <p>
                <button class="btn btn-sm btn-default" title="Attach file"><i class="glyphicon glyphicon-paperclip"></i></button>
                <button class="btn btn-sm btn-default" title="Copy issue"><i class="fa fa-clone"></i></button>
                <button class="btn btn-sm btn-default" title="Link issue"><i class="glyphicon glyphicon-link"></i></button>
                <button class="btn btn-sm btn-default" title="More"><i class="fa fa-ellipsis-h"></i></button>
            </p>
            <div>
                <textarea id="txtDesc" class="form-control" placeholder="Add a description..."></textarea>
                <div id="descActions"></div>
            </div>
            <div class="form-group">
                <div class="row flex-display">
                    <h4 class="col-md-2 col-xs-2">Activities</h4>
                    <div class="col-md-10 col-xs-10 flex-center flex-right">
                        <span class="dropdown-toggle" data-toggle="dropdown">Comments
                        <span class="fa fa-caret-down"></span></span>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item"><a href="#">History</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <img src="/images/icons_user.svg" class="img-circle" alt="User Image">
                    </div>
                    <div class="col-md-10 col-xs-10">
                        <textarea id="txtComment" class="form-control" placeholder="Add a comment..."></textarea>
                        <div id="commentActions"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <dl>
                <dt>Status</dt>
                <dd>
                    <select class="form-control" name="projectId" id="projectId">
                        @foreach($issueStatus as $status)
                        @php
                            $selected = $bugDetail->issue_status == $status->id ? "selected" : "";
                        @endphp
                            <option {{ $selected }} value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </dd>
                <dt>Người thực hiện</dt>
                <dd>
                    <div class="form-group">
                        <div class="row flex-display">
                            <div class="col-md-2 col-xs-2">
                                <img src="/images/icons_user.svg" class="img-circle" alt="User Image">
                            </div>
                            <div class="col-md-10 col-xs-10 flex-center">
                                <select class="form-control" name="assignee" id="assignee">
                                    <option value="0">Unassigned</option>
                                    @foreach($assignees as $assignee)
                                    @php
                                        $selected = $bugDetail->assignee == $assignee->id ? "selected" : "";
                                    @endphp
                                        <option {{ $selected }} value="{{ $assignee->userinvited->id }}">{{ $assignee->userinvited->full_name }}</option>
                                    @endforeach
                                    {{ !empty($assignee->full_name) ? $assignee->full_name : "Unknow" }}
                                </select>
                            </div>
                        </div>
                    </div>
                </dd>
                <dt>Người báo cáo</dt>
                <dd>
                    <div class="form-group">
                        <div class="row flex-display">
                            <div class="col-md-2 col-xs-2">
                                <img src="/images/icons_user.svg" class="img-circle" alt="User Image">
                            </div>
                            <div class="col-md-10 col-xs-10 flex-center">
                                {{ !empty($reporter->full_name) ? $reporter->full_name : "Unknow" }}
                            </div>
                        </div>
                    </div>
                </dd>
                <dt>Nhãn</dt>
                <dd>
                    <select class="form-control" name="priorityId" id="priorityId">
                    @foreach($labels as $label)
                    @php
                        $selected = $bugDetail->label == $label->id ? "selected" : "";
                    @endphp
                        <option {{ $selected }} value="{{ $label->id }}">{{ $label->name }}</option>
                    @endforeach
                    </select>
                </dd>
                <dt>Ưu tiên</dt>
                <dd>
                    <select class="form-control" name="priorityId" id="priorityId">
                    @foreach($priorities as $priority)
                    @php
                        $selected = $bugDetail->priority_id == $priority->id ? "selected" : "";
                    @endphp
                        <option {{ $selected }} value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                    </select>
                </dd>
            </dl>
            <hr>
            <div id="moreInfo" class="collapse">
                <dl>
                    <dt>Status</dt>
                    <dd>a</dd>
                    <dt>Người thực hiện</dt>
                    <dd>b</dd>
                    <dt>Người báo cáo</dt>
                    <dd>c</dd>
                </dl>
            </div>
            <div><a class="btn-toggle-advance" data-toggle="collapse" href="#moreInfo">Show more</a></div>
            <div>
                <p>Created {{ $createdTemp }}</p>
                <p>Updated {{ $updatedTemp }}</p>
            </div>
        </div>
        @else
            <h3>Have no information for this issue or this issue id is not exist</h3>
        @endif
    </div>
</div>
@stop
@section('script')
    <script type="text/javascript">
        var issueId = "{{ $bugDetail->id }}";
        var TOKEN = "{{ csrf_token() }}";
    </script>
    <script type="text/javascript" src="{{ asset('js/bug_detail.js') }}"></script>
@stop