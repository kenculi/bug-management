$('#txtDesc').on("click", function() {
	if ($("#descActions").is(':empty')) {
		$("#descActions").append('<button type="button" class="btn btn-default btn-xs" onclick="updateDesc(' + issueId + ')"><i class="glyphicon glyphicon-ok"></i></button> <button type="button" class="btn btn-default btn-xs" onclick="cancelUpdate(this)"><i class="glyphicon glyphicon-remove"></i></button>');
	}
});

$('#txtComment').on("click", function() {
	if ($("#commentActions").is(':empty')) {
		$("#commentActions").append('<button type="button" class="btn btn-default btn-xs" onclick="addComment(' + issueId + ')"><i class="glyphicon glyphicon-ok"></i></button> <button type="button" class="btn btn-default btn-xs" onclick="cancelUpdate(this)"><i class="glyphicon glyphicon-remove"></i></button>');
	}
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
        		toastr["success"]('Description was updated');
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
        url: "/board/update-status",
        success: function(response) {
            if (!response['error']) {
                toastr["success"]('Status was updated');
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
                toastr["success"]('Assignee was changed');
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
                toastr["success"]('Priority was updated');
            }
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