@extends('master')
@section('title', 'Board')
@section('page-header') {{ $project_name }} @stop
@section('cssloader')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
    .tDnD_whileDrag {
        opacity: 0.5;
        border: 2px dashed coral;
    }
    .box-toggle {
        position: absolute;
        top: 50%;
        right: 0;
        margin-top: -8px;
    }
    .box-placeholder {
        border: 1px dotted black;
        margin: 0 1em 1em 0;
        height: 50px;
    }
    .img-circle { border: 2px solid #3c8dbc; }
    .img-circle:hover { border: 3px solid #fff; }
    .after_row {
        margin-bottom: 20px;
    }
</style>
@stop

@section('breadcrumb')
<div class="breadcrumb">
    <a href="{{ url('/board/create-issue') }}" class="modal-trigger" data-url="{{ url('/board/create-issue') }}"><button type="button" class="btn btn-block btn-success btn-sm">Create issue</button></a>
</div>
@stop

@section('content')
    <div id='my-modal' class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <iframe src="" width="100%" scrolling="yes" frameborder="0"></iframe>
            </div>
        </div>
    </div>



    <!-- /.search form -->
    <div class="row after_row">
        <div class="col-md-2">
            <form action="#" method="get">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <img src="{{ asset('images/icons_user.svg') }}" width="30px" class="img-circle" alt="User Image">
            <img src="{{ asset('images/add_user_icon.svg') }}" width="30px" class="img-circle" alt="Add member" data-toggle="modal" data-target="#formMoiUser">
        </div>
    </div>

    <div class="row">
        @foreach ($issue_statuss as $issue_status)
    	<div class="col-md-2 column">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">{{ $issue_status->name }}</h1>
    			</div>
    			<div class="box-body" id={!! $issue_status->id !!}>
                    <ul id="card_list_1" data="{!! $issue_status->id !!}" class="connectedSortable todo-list card_list">
                        @foreach ($issues as $issue)
                            @if ($issue->issue_status == $issue_status->id)
                                <li id="{!! $issue->id !!}"><a href="{{ url('/board/bug-detail/'.$issue->id) }}" class="modal-trigger" data-url="{{ url('/board/bug-detail/' .$issue->id) }}">{!! $issue->summary !!}</a></li>
                            @endif
                        @endforeach
                        {{-- <li> <a href="">Link tạo issue</a></li> --}}
                    </ul>
                </div>
    		</div>
    	</div>
        @endforeach
    	<div class="col-md-1">
    		<button type="button" class="btn btn-default btn-md" title="Create column"> + </button>
    	</div>
    </div>
@stop

@section('jsloader')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/dragable.js') }}"></script>
@stop

<div id="formMoiUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invite To Board</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="usr" placeholder="Email address or name">
        <br>
        <textarea class="form-control" rows="5" id="msgInvite"></textarea>
        <br>
        <button type="button" class="btn btn-default form-control" id="btnInvite">Send Invitation</button>

        <br>
        <div style="padding-top: 10px;padding-bottom: 10px">
            <div style="float: left;">
                    <span class="glyphicon glyphicon-link" ></span>
                    <label>Invite With Link</label>
                </div>
                <div style="float: right">
                    <a href="#">Create Link</a>
            </div>
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
    </div>

  </div>
</div>