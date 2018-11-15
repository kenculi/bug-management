@extends('master')
@section('title', 'Quản lý dự án')
@section('page-header', 'Danh sách dự án')
@section('content')
    <div id="my-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <iframe src="" width="100%" scrolling="yes" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
        	<div id="table-info-head" class="row">
                <div class="col-md-12">
                    <a href="javascript:;" class="btn btn-primary modal-trigger" data-url="/project/create" title="Thêm dự án mới"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm</a>
                </div>
            </div>
            @if(!empty($projects))
                <div class="scroll-box">
                <table id="projectTbl" class="table my-table table-striped table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên dự án</th>
                            <th>Người tạo</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Mời thành viên</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $value)
                          <tr>
                            <td><a href="/project/active-project/{{ $value->id }}">{{ $value->name }}</a></td></td>
                            <td>{{ $value->user->full_name }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($value->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($value->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td align="center">
                            	<a href="">Mời</a>
                            </td>
                            <td align="center">
                                <a href="/project/active-project/{{ $value->id }}" title="Quản lý lỗi"><i class="glyphicon glyphicon-info-sign"></i></a>&nbsp;
                            	<a href="" class="modal-trigger" data-url="/project/edit/{{ $value->id }}" title="Sửa"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;
                            	<a href="" class="modal-trigger" data-url="/project/delete/{{ $value->id }}" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            @endif
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript">
	$('#projectTbl').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
</script>
@stop