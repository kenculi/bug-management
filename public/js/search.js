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