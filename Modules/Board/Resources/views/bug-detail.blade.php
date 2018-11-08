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
        <span class="projTitle">Bug ID</span>
    </h4>
</div>
<div class="box-body form-scrolling bug-detail">
    <div class="row">
        <div class="col-md-7 col-xs-7">
            <h3>Bug title</h3>
            <p>
                <button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-paperclip"></i></button>
                <button class="btn btn-sm btn-default"><i class="fa fa-clone"></i></button>
                <button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-link"></i></button>
                <button class="btn btn-sm btn-default"><i class="fa fa-ellipsis-h"></i></button>
            </p>
            <div>
                <textarea class="form-control" placeholder="Add a description..."></textarea>
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
                        <textarea class="form-control" placeholder="Add a comment..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <dl>
                <dt>Status</dt>
                <dd>a</dd>
                <dt>Người thực hiện</dt>
                <dd>
                    <div class="form-group">
                        <div class="row flex-display">
                            <div class="col-md-2 col-xs-2">
                                <img src="/images/icons_user.svg" class="img-circle" alt="User Image">
                            </div>
                            <div class="col-md-10 col-xs-10 flex-center">
                                Unknow
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
                                Unknow
                            </div>
                        </div>
                    </div>
                </dd>
                <dt>Nhãn</dt>
                <dd>d</dd>
                <dt>Ưu tiên</dt>
                <dd>e</dd>
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
                <p>Created 4 hours ago</p>
                <p>Updated 32 minutes ago</p>
            </div>
        </div>
    </div>
</div>
@stop