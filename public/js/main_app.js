var error = $('.has-error:first');

if ($('.modal').length >= 1) {
    var modal = new Modal('#my-modal', '.modal-trigger');
}

if (window.frameElement) { // in iframe

    // dismiss modal when clicking to 'cancel' button in iframe
    var modal = window.parent.$('.modal');
    $('.btn-cancel').click(function(){
        modal.modal('hide');
    });
    if (error.length > 0) {
        $('.modal-body').animate({
            scrollTop: error.offset().top - 65 // modal header height
        }, 500);
    }
} else { // not in iframe

    // define toastr options
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "6000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    // Scroll to the first error
    if (error.length > 0) {
        $('html, body').animate({
            scrollTop: error.offset().top
        }, 500);
    }
}