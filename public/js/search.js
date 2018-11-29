function resetTo(nameFrom, nameTo) {
    var startDate = $('input[name="'+nameFrom+'"]').datepicker('getDate');
    $('input[name="'+nameTo+'"]').datepicker('update', '');
    if (! startDate) {
        $('input[name="'+nameTo+'"]').prop('disabled', true);
        return $('input[name="'+nameTo+'"]').datepicker('destroy');
    }
    $('input[name="'+nameTo+'"]').prop('disabled', false);
    $('input[name="'+nameTo+'"]').datepicker('setStartDate', startDate);
}

function initRangeDatePicker(fromData, nameFrom, nameTo, onchange = null) {
    $.fn.datepicker.defaults.orientation = 'bottom auto';
    $.fn.datepicker.defaults.format = 'dd/mm/yyyy';
    $('input[name="'+nameFrom+'"]').datepicker({format: 'dd/mm/yyyy'});
    $('input[name="'+nameFrom+'"]').on('changeDate', function() {
        resetTo(nameFrom, nameTo);
        onchange && onchange();
    });
    $('input[name="'+nameFrom+'"]').on('change', function() {
        resetTo(nameFrom, nameTo);
        onchange && onchange();
    });

    if (fromData) {
        $('input[name="'+nameTo+'"]').datepicker('setStartDate', fromData);
        $('input[name="'+nameTo+'"]').prop('disabled', false);
    } else {
        $('input[name="'+nameTo+'"]').prop('disabled', true);
    }
}

function loadAssigneeAndStatus() {
    var projectId = $('select[name="projectId"]').val();
    var slbAssignee = $('select[name="assignee"]');
    var slbStatus = $('select[name="status"]');
    slbAssignee.find('option').not(':first').remove();
    slbStatus.find('option').not(':first').remove();
    $.ajax({
        type: "POST",
        data: { "projectId": projectId, "_token": TOKEN },
        url: "/search/load-assignee-status",
        success: function(response) {
            if (!response['error']) {
                if (response['assignees']) {
                    response['assignees'].forEach(function(value) {
                        slbAssignee.append('<option value=' + value.user_receive_id + '>' + value.full_name + '</option>');
                    });
                }

                if (response['status']) {
                    response['status'].forEach(function(value) {
                        slbStatus.append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                }
            }
        }
    });
}

function createReport() {
    $.ajax({
        type: "POST",
        data: { "data": $('#formSearch').serialize(), "_token": TOKEN },
        url: "/search/create-report",
        success: function(response) {
            if (!response['error']) {
                document.getElementById('downloadIframe').src = "/board/download-file-delete/"+response['fileName'];
            }
        }
    });
}

function ajaxLoadData() {
    $('#issuesTbl').DataTable({
        'destroy'       : true,
        'paging'        : true,
        'lengthChange'  : true,
        'searching'     : false,
        'ordering'      : true,
        'info'          : true,
        'autoWidth'     : true,
        "processing"    : true,
        "serverSide"    : true,
        "ajax": {
            "url": "/search/ajax-load-data",
            "type": "POST",
            "data": {"data": $('#formSearch').serialize()}
        },
        "columns":[
            {"data" : "projectName"},
            {"data" : "issueCode","orderable" : false},
            {"data" : "summary"},
            {"data" : "statusName","orderable" : false},
            {"data" : "assignee"},
            {"data" : "created_at"},
        ]
    });
}

$('#searchBtn').on("click", function(event) {
    ajaxLoadData();
});