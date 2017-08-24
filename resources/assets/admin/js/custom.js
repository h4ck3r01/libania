(function ($) {

    $('.alert').delay(3000).fadeOut();

    $('.select2').select2({
        tags: true,
        ajax: {
            dataType: 'json'
        }
    });


})(jQuery);