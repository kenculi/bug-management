@extends('master')
@section('title', 'Tìm kiếm lỗi')
@section('page-header', 'Tìm kiếm lỗi')
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="summary" class="control-label">Tên lỗi</label>
                            <div>
                                <input type="text" class="form-control input-text-selectize" name="summary" id="summary" placeholder="Nhập tóm tắt lỗi" value="{{ old('summary') }}">
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
                    <button type="submit" class="btn btn-info btn-md" title="Tìm kiếm"> Tìm kiếm</button>
                </div>
            </form>

            @if(!empty($issueList))
                <div class="scroll-box">
                <table class="table my-table table-striped table-bordered" cellspacing="0">
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
                    <tbody>
                        @foreach ($issueList as $value)
                          <tr>
                            <td></td>
                            <td></td>
                            <td>{{ $value->summary }}</td>
                            <td></td>
                            <td>{{ $value->assigneeinfo->full_name }}</td>
                            <td>{{ $value->created_at }}</td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            @endif
        </div>
    </div>

    <div class="box">

    </div>
@stop

@section('script')
    <script type="text/javascript">
            var TOKEN = "{{ csrf_token() }}";
        </script>
    <script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@stop