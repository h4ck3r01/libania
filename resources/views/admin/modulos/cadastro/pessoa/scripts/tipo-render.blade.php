function ( data, type, row ) {

    if (data == 1) {
        return '{!! __('views.admin.pessoa.tipo_1') !!}' ;
    } else if (data == 2) {
        return '{!! __('views.admin.pessoa.tipo_2') !!}';
    } else {
        return '{!! __('views.admin.pessoa.tipo_3') !!}';
    }
}