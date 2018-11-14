@extends('master')
@section('title', 'Issue')
@section('page-header') {{ !empty($bugDetail) ? $firstLetter . $bugDetail->id : "" }} @stop
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

    select.slbActivities {
        border: 0px;
        background: #fff;
    }
    #historyBox {
        display: none;
    }
    .removeBolderText {
        font-family: initial;
        font-weight: initial;
    }
</style>
@stop
@section('content')
<div class="bug-detail">
    {{ csrf_field() }}
    <div class="row">
        @if (!empty($bugDetail))
        <div class="col-md-7 col-xs-7">
            <h3>{{ $bugDetail->summary }}</h3>
            <p>
                <button class="btn btn-sm btn-default" title="Attach file"><i class="glyphicon glyphicon-paperclip"></i></button>
                <button class="btn btn-sm btn-default" title="Copy issue"><i class="fa fa-clone"></i></button>
                <button class="btn btn-sm btn-default" title="Link issue"><i class="glyphicon glyphicon-link"></i></button>
            </p>
            <div>
                <textarea id="txtDesc" class="form-control" placeholder="Add a description...">{{ $bugDetail->description }}</textarea>
                <div id="descActions"></div>
            </div>
            <div class="form-group">
                <div class="row flex-display">
                    <h4 class="col-md-2 col-xs-2">Activities</h4>
                    <div class="col-md-10 col-xs-10 flex-center flex-right">
                        <select name="slbActivities" class="slbActivities" onchange="changeActivity(this)">
                            <option value="1">Comments</option>
                            <option value="2">History</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="commentBox">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <textarea id="txtComment" class="form-control" placeholder="Add a comment..."></textarea>
                            <div id="commentActions"></div>
                        </div>
                    </div>
                </div>
                <div class="chat" id="box-comment">
                    @foreach($comments as $comment)
                    <div class="item">
                        <img src="/images/icons_user.svg" alt="user image" class="img-circle">
                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</small>
                                {{ $comment->usercommented->full_name }}
                            </a>
                            {{ $comment->description }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="historyBox">
                @if (!empty($history))
                <div class="chat">
                    @foreach($history as $value)
                    <div class="item">
                        <img src="/images/icons_user.svg" alt="user image" class="img-circle">
                        <p class="message">
                            <span href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $value->created_at }}</small>
                                <a>{{ $value->userloged->full_name }}</a> <span class="removeBolderText">đã thay đổi</span> {{ $value->getUpdatedField() }}
                            </span>
                            {{ $value->note }}
                        </p>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <dl>
                <dt>Status</dt>
                <dd>
                    <select class="form-control" name="projectId" id="projectId" onchange="updateStatus(this)">
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
                                <select class="form-control" name="assignee" id="assignee" onchange="updateAssignee(this)">
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
                    <select class="form-control select2" id="label" name="labels" multiple="multiple" data-placeholder="Nhãn">
                        @foreach($labels as $label)
                        @php
                            $arrLabelIds = explode(",", $bugDetail->label);
                            $selected = in_array($label->id, $arrLabelIds) ? "selected" : "";
                        @endphp
                            <option {{ $selected }} value="{{ $label->id }}">{{ $label->label }}</option>
                        @endforeach
                    </select>
                    <div id="labelActions"></div>
                </dd>
                <dt>Ưu tiên</dt>
                <dd>
                    <select class="form-control" name="priorityId" id="priorityId" onchange="updatePriority(this)">
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