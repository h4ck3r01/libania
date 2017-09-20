function () {

    var column = this.api().columns(3);

    $('#tipo')
        .on('change', function () {

            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );

            column.search(val, false, false, true).draw();

    });

}