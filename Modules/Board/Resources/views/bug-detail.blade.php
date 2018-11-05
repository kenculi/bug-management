@extends('iframe')
@section('content')
<div class="modal-header">
    <button type="button" class="close btn-cancel" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <button type="button" class="close dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="padding-right-10">...</span></button>
    <h4 class="modal-title" id="myModalLabel">
        <span class="projTitle">Bug ID</span>
    </h4>
</div>
<div class="box-body">
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
            <div>
                <h4 class="box-title">Activities</h4>
                <div class="input-group-btn">
                  <button class="btn btn-warning dropdown-toggle pull-right" data-toggle="dropdown">Comments
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <dl>
                <dt>Status</dt>
                <dd>a</dd>
                <dt>Người thực hiện</dt>
                <dd>b</dd>
                <dt>Người báo cáo</dt>
                <dd>c</dd>
                <dt>Nhãn</dt>
                <dd>d</dd>
                <dt>Ưu tiên</dt>
                <dd>e</dd>
            </dl>
        </div>
    </div>
</div>
@stop