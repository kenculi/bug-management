@extends('master')
@section('title', 'Bảng')
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
    <a href="{{ url('/board/create-issue') }}" class="modal-trigger" data-url="{{ url('/board/create-issue') }}"><button type="button" class="btn btn-block btn-success btn-sm">Tạo lỗi</button></a>
</div>
@stop

@section('content')
    @if (!$projectId)
        <h3>Vui lòng chọn <a href="/project">dự án</a> để kích hoạt bảng làm việc</h3>
    @else
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
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm..." value="{{ old('keyword') }}">
                        <span class="input-group-btn">
                            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                @foreach($invited as $value)
                    <img src="{{ asset('images/avatar/'.$value->getUserInvited()->avatar) }}" width="30px" height="30px" class="img-circle" alt="User Image" title="{{ $value->getUserInvited()->full_name }}">
                @endforeach
            </div>
        </div>

        <div class="row" id="statusColumn">
            @foreach ($issue_status as $issue_status)
        	<div class="col-md-2" id="{{ $issue_status->id }}">
        		<div class="box">
        			<div class="box-header with-border">
        				<h3 class="box-title">{{ $issue_status->name }}</h1>
        			</div>
        			<div class="box-body" id={!! $issue_status->id !!}>
                        <ul id="card_list_{!! $issue_status->id !!}" data-target="{!! $issue_status->id !!}" class="connectedSortable todo-list card_list">
                            @foreach ($issues as $issue)
                                @if ($issue->issue_status == $issue_status->id)
                                    <li id="{!! $issue->id !!}"><a href="{{ url('/board/bug-detail/'.$issue->id) }}" class="modal-trigger" data-url="{{ url('/board/bug-detail/' .$issue->id) }}">{!! $issue->summary !!}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
        		</div>
        	</div>
            @endforeach
        	<div class="col-md-1">
                <a href="{{ url('/board/create-status') }}" class="modal-trigger" data-url="{{ url('/board/create-status') }}">
        		  <button type="button" class="btn btn-default btn-md" title="Thêm trạng thái"> + </button>
                </a>
        	</div>
        </div>
    @endif
@stop

@section('script')
<script type="text/javascript">
    var TOKEN = "{{ csrf_token() }}";
    var projectId = {{ $projectId }};
</script>
@stop

@section('jsloader')
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/dragable.js') }}"></script>
@stop