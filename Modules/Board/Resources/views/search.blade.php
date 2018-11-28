@extends('master')
@section('title', 'Tìm kiếm lỗi')
@section('page-header', 'Tìm kiếm lỗi')
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" id="formSearch">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="summary" class="control-label">Tên lỗi</label>
                            <div>
                                <input type="text" class="form-control input-text-selectize" name="summary" id="summary" placeholder="Nhập tóm tắt lỗi" value="{{ old('summary') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="summary" class="control-label">Ngày tạo</label>
                            <div>
                                <input type="text" class="form-control" name="createdFrom" id="created_at" placeholder="Từ ngày" value="{{ old('createdFrom') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="summary" class="control-label"> &nbsp;</label>
                            <div>
                                <input type="text" class="form-control" name="createdTo" id="created_at" placeholder="Đến ngày" value="{{ old('createdTo') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="projectId">Dự án</label>
                        <select class="form-control" name="projectId" id="projectId" onchange="loadAssigneeAndStatus()">
                            <option value="0">Tất cả</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="assignee">Người thực hiện</label>
                        <select class="form-control" name="assignee" id="assignee">
                            <option value="0">Tất cả</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Trạng thái</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0">Tất cả</option>
                        </select>
                    </div>
                </div>
                <div class="row col-md-4">
                    <button type="button" id="searchBtn" class="btn btn-info btn-md" title="Tìm kiếm"> Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

        <div class="box">
            <div class="box-body">
                <div class="scroll-box">
                    <table id="issuesTbl" class="table my-table table-striped table-bordered" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Dự án</th>
                                <th>Mã lỗi</th>
                                <th>Tóm tắt</th>
                                <th>Trạng thái</th>
                                <th>Người thực hiện</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
@stop

@section('script')
    <script type="text/javascript">
        var TOKEN = "{{ csrf_token() }}";
        $('input[name="created_at"]').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        })

    </script>
    <script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            initRangeDatePicker(
                '{{ old('createdFrom') }}',
                'createdFrom',
                'createdTo'
            );
            ajaxLoadData();
        });
    </script>
@stop