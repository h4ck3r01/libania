(function ($) {

    //alert
    $('.alert').delay(3000).fadeOut();

    //select2
    $('.select2').select2({
        tags: true,
        width: '100%',
    });

    $(':reset').on('click', function (e) {

        e.preventDefault();

        $('form')[0].reset();

        $('.select2').trigger('change');
    });

})(jQuery);