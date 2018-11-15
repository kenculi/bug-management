$(function() {
    var oldSequence = [];
    $("#statusColumn").sortable({
        revert: true,
        start: function(event, ui) {
            value = []
            var listElement = $("#statusColumn").find("div[class='col-md-2 ui-sortable-handle']");
            listElement.each(function(){
                value.push($(this).attr('id'));
            });
            oldSequence = value;
        },
        stop: function (event, ui) {
            var newSequence = [];
            var listElement = $("#statusColumn").find("div[class='col-md-2 ui-sortable-handle']");
            listElement.each(function(){
                newSequence.push($(this).attr('id'));
            });

            if(JSON.stringify(oldSequence) != JSON.stringify(newSequence)) {
                $.ajax({
                    type: "POST",
                    data: { "sortedIds": newSequence, "_token": TOKEN },
                    url: "/board/update-sequence",
                    success: function(response) {
                    }
                });
            }
        }
    }).disableSelection();

    $(".box")
        .addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
        .find(".box-header")
            .addClass("ui-widget-header ui-corner-all");

    $( ".card_list" ).sortable({
        items: 'li',
        revert: true,
        connectWith: ".connectedSortable",
        stop: function (event, ui) {
            var issue_id = ui.item.attr('id');
            var status = ui.item.parent().attr('data-target');
            jQuery.ajax({
              method: "POST",
              url: "/board/update-status",
              data: { "issue_id": issue_id, "status": status, "_token": TOKEN }
            })
            .done(function( msg ) {
            });
        }
    }).disableSelection();
});