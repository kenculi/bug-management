$('#txtDesc').on("click", function() {
	if ($("#commentActions").is(':empty')) {
		$("#commentActions").append('<button type="button" class="btn btn-default btn-xs" onclick="updateDesc(' + issueId + ')"><i class="glyphicon glyphicon-ok"></i></button> <button type="button" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-remove"></i></button>');
	}
});

function updateDesc(issueId) {
	var TOKEN = $('input[name="_token"]').val();
	var desc = $("#txtDesc").val();
	console.log(TOKEN, desc);
	$.ajax({
        type: "POST",
        data: { "issueId": issueId, "desc": desc, "_token": TOKEN },
        url: "/board/update-desc",
        success: function(response) {

        }
    });
}