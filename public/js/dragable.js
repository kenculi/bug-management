$(function() {
    $("#statusColumn").sortable({
        revert: true,
        // update: function(event, ui) { 
        //     var newSequence = [];
        //     $("#statusColumn").children().forEach(function (index, el) {
        //         console.log(el.attr("data-sequence"));
        //     });
        // },
        start: function(event, ui) {
            var oldSequence = [];
            var listElement = $("#statusColumn").children();
            listElement.each(function(element){
                oldSequence.push($(element).attr('data-sequence'));
            });
            console.log(oldSequence);
        },
        stop: function (event, ui) {
            // var sequence = ui.item.attr('data-sequence');
            // var targetSequence = ui.item[0].previousElementSibling;
            // if (!targetSequence) {
            //     targetSequence = 1;
            // } else {
            //     targetSequence = targetSequence.getAttribute('data-sequence');
            // }
            // console.log(sequence, targetSequence);
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