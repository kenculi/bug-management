$(".select2").select2({
   	tags: true,
    multiple: true,
    tokenSeparators: [',', ' '],
});

$('#txtDesc').on("click", function() {
	if ($("#descActions").is(':empty')) {
		$("#descActions").append('<button type="button" class="btn btn-default btn-xs" onclick="updateDesc(' + issueId + ')"><i class="glyphicon glyphicon-ok"></i></button> <button type="button" class="btn btn-default btn-xs" onclick="cancelUpdate(this)"><i class="glyphicon glyphicon-remove"></i></button>');
	}
});

$('#label').on("change", function() {
	if ($("#labelActions").is(':empty')) {
		$("#labelActions").append('<button type="button" class="btn btn-default btn-xs" onclick="updateLabel(' + issueId + ')"><i class="glyphicon glyphicon-ok"></i></button> <button type="button" class="btn btn-default btn-xs" onclick="cancelUpdate(this)"><i class="glyphicon glyphicon-remove"></i></button>');
	}
});

$('#txtComment').on("click", function() {
	if ($("#commentActions").is(':empty')) {
		$("#commentActions").append('<button type="button" class="btn btn-default btn-xs" onclick="addComment(' + issueId + ')"><i class="glyphicon glyphicon-ok"></i></button> <button type="button" class="btn btn-default btn-xs" onclick="cancelUpdate(this)"><i class="glyphicon glyphicon-remove"></i></button>');
	}
});

$('#attachButton').on("click", function() {
    $('input[name="attachFile"]').click();
});

function updateDesc(issueId) {
	var desc = $("#txtDesc").val();
	$.ajax({
        type: "POST",
        data: { "issueId": issueId, "description": desc, "_token": TOKEN },
        url: "/board/update-desc",
        success: function(response) {
        	if (!response['error']) {
        		document.getElementById("descActions").innerHTML = "";
        		toastr["success"]('Cập nhật mô tả thành công');
        	}
        }
    });
}

function addComment(issueId) {
	var comment = $("#txtComment").val();
	$.ajax({
        type: "POST",
        data: { "issueId": issueId, "comment": comment, "_token": TOKEN },
        url: "/board/add-comment",
        success: function(response) {
        	if (!response['error']) {
        		document.getElementById("commentActions").innerHTML = "";
                window.location.reload();
        	}
        }
    });
}

function updateStatus(object) {
    var issueStatus = object.value;
    $.ajax({
        type: "POST",
        data: { "issueId": issueId, "issueStatus": issueStatus, "_token": TOKEN },
        url: "/board/update-status-issue",
        success: function(response) {
            if (!response['error']) {
                toastr["success"]('Cập nhật trạng thái thành công');
            }
        }
    });
}

function updateAssignee(object) {
    var assignee = object.value;
    $.ajax({
        type: "POST",
        data: { "issueId": issueId, "assignee": assignee, "_token": TOKEN },
        url: "/board/update-assignee",
        success: function(response) {
            if (!response['error']) {
                toastr["success"]('Cập nhật người thực hiện thành công');
            }
        }
    });
}

function updatePriority(object) {
    var priorityId = object.value;
    $.ajax({
        type: "POST",
        data: { "issueId": issueId, "priorityId": priorityId, "_token": TOKEN },
        url: "/board/update-priority",
        success: function(response) {
            if (!response['error']) {
                toastr["success"]('Cập nhật ưu tiên thành công');
            }
        }
    });
}

function updateLabel(object) {
    var labels = $("select[name='labels']").val();
    $.ajax({
        type: "POST",
        data: { "issueId": issueId, "labels": labels, "_token": TOKEN },
        url: "/board/update-label",
        success: function(response) {
            if (!response['error']) {
                toastr["success"]('Cập nhật nhãn thành công');
            } else {
            	toastr["error"](response['message']);
            }
            document.getElementById("labelActions").innerHTML = "";
        }
    });
}

function changeActivity(object) {
    var activityId = object.value;
    if (activityId == "1") {
        document.getElementById('commentBox').style.display = "block";
        document.getElementById('historyBox').style.display = "none";
    } else {
        document.getElementById('commentBox').style.display = "none";
        document.getElementById('historyBox').style.display = "block";
    }
}

function cancelUpdate(object) {
	object.parentElement.innerHTML = "";
}

function uploadAttachment() {
    var attachment = document.getElementById('attachFile');
    var data = new FormData();
    data.append('attachment', attachment.files[0]);
    data.append('_token', TOKEN);
    data.append('issueId', issueId);

    $.ajax({
        type: 'POST',
        contentType: false,
        processData: false,
        data: data,
        url: "/board/attach-file",
        success: function (response) {
            if (!response['error']) {
                toastr["success"]('Tải tập tin đính kèm thành công');
                window.location.reload();
            }
        }
    });
}

function downloadFile(fileName) {
    document.getElementById('downloadIframe').src = "/board/download-file/"+fileName;
}