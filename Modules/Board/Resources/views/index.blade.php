@extends('master')
@section('title', 'Board')
@section('page-header', 'Project A')
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
            <img src="{{ asset('images/add_user_icon.svg') }}" width="30px" class="img-circle" alt="Add member">
        </div>
    </div>

    <div class="row">
    	<div class="col-md-2 column">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Khởi tạo</h1>
    			</div>
    			<div class="box-body">
                    <ul id="card_list_1" class="connectedSortable todo-list card_list">
                        <li id="1"><a href="javascript:;" class="modal-trigger" data-url="/board/bug-detail/1">Title 1</a></li>
                        <li id="2">Title 2</li>
                        <li id="3">Title 3</li>
                        <li> <a href="">Link tạo issue</a></li>
                    </ul>
                </div>
    		</div>
    	</div>
    	<div class="col-md-2 column">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Thực thi</h1>
    			</div>
    			<div class="box-body">
                    <ul id="card_list_2" class="connectedSortable todo-list card_list">
                        <li> <a href="">Link tạo issue</a></li>
                        
                    </ul>
                </div>
    		</div>
    	</div>
    	<div class="col-md-2 column">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Kiểm tra</h1>
    			</div>
    			<div class="box-body">
                    <ul id="card_list_3" class="connectedSortable todo-list card_list">
                        <li> <a href="">Link tạo issue</a></li>
                    </ul>
                </div>
    		</div>
    	</div>
    	<div class="col-md-2 column">
    		<div class="box">
    			<div class="box-header with-border">
    				<h3 class="box-title">Hoàn thành</h1>
    			</div>
    			<div class="box-body">
                    <ul id="card_list_4" class="connectedSortable todo-list card_list">

                    </ul>
                </div>
    		</div>
    	</div>
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