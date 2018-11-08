$(function() {
    $(".column").sortable({
        connectWith: ".column",
        handle: ".box-header",
        placeholder: "box-placeholder ui-corner-all"
    });

    $(".box")
        .addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
        .find(".box-header")
            .addClass("ui-widget-header ui-corner-all");

    // $( "#card_list_1, #card_list_2, #card_list_3, #card_list_4" ).sortable({
    // $(".card_list").on("click","li", function(){
    //     alert($(this).attr("id"));
    // });

    $( ".card_list" ).sortable({
        items: 'li',
        revert: true,
        connectWith: ".connectedSortable",
        // start: function (event, ui) {
        //     alert(ui.item.attr('id'));
        // },
        stop: function (event, ui) {
            var issue_id = ui.item.attr('id');
            var status = ui.item.parent().attr('data-target');
            jQuery.ajax({
              method: "POST",
              url: "board/update-status",
              data: { issue_id: issue_id, status: status }
            })
            .done(function( msg ) {
                alert( "OK");
            });
        }
    }).disableSelection();

    // $(".card_list li").draggable({
    //     connectWith: ".connectedSortable li",
    //     stop: function (event, ui) {
    //         alert($(this).attr("id"));
    //     }
    // });
});