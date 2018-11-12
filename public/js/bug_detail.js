$('#txtDesc').on("click", function() {
	if ($("#descActions").is(':empty')) {
		$("#descActions").append('<button type="button" class="btn btn-default btn-xs" onclick="updateDesc(' + issueId + ')"><i class="glyphicon glyphicon-ok"></i></button> <button type="button" class="btn btn-default btn-xs" onclick="cancelUpdate(this)"><i class="glyphicon glyphicon-remove"></i></button>');
	}
});

$('#txtComment').on("click", function() {
	console.log($("#commentActions").is(':empty'));
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
        		toastr["success"]('Comment was added');
        	}
        }
    });
}

function cancelUpdate(object) {
	object.parentElement.innerHTML = "";
}