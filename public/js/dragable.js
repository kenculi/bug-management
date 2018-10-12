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
    $( ".card_list" ).sortable({
        connectWith: ".connectedSortable"
    }).disableSelection();
});