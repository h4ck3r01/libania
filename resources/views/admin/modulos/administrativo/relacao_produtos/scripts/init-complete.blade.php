function () {

    var column = this.api().columns(2);

    $('#categoria')
        .on('change', function () {

            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );

            column
                .search( val ? '^'+val+'$' : '', true, false)
                .draw();

    });

}