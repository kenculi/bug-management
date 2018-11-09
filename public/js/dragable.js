$(function() {
    $(".column").sortable({
        connectWith: ".column",
        handle: ".box-header",
        placeholder: "box-placeholder ui-corner-all"
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
              url: "board/update-status",
              data: { issue_id: issue_id, status: status }
            })
            .done(function( msg ) {
                alert( "OK");
            });
        }
    }).disableSelection();
});