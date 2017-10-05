<script>

    $(document).ready(function () {

        $('#table-categorias tbody').on('click', 'tr', function () {

            $(this).toggleClass('active').siblings().removeClass('active');

            if ($(this).hasClass('active')) {
                $("#categoria_update").attr('disabled', false);
                $("#categoria_delete").attr('disabled', false);

                let nome = $(this).find('td').eq(1).text();
                let fluxo = $(this).find('td').eq(2).text();

                (fluxo == '{{__('views.admin.cc.fluxo_1')}}') ? fluxo = 1 : fluxo = 2;

                $('#categoria_nome').val(nome);
                $('input[name=categoria_fluxo][value=' + fluxo + ']').attr('checked', 'checked');

            }
            else {
                $("#categoria_update").attr('disabled', true);
                $("#categoria_delete").attr('disabled', true);
            }
        });

        $("#categoria_insert").on('click', function () {
            $('#categoria_nome').val('');
            $('#categoria_fluxo').val('1');
            $("#categoria_operation").val('insert');
        });

        $("#categoria_update").on('click', function () {
            $("#categoria_operation").val('update');
        });

        $('#form-categoria').on('submit', function (e) {

            e.preventDefault();

            if ($(this).parsley().isValid()) {

                let operation = $("#categoria_operation").val();

                let url, type;

                if (operation == 'insert') {
                    url = '{{  route('financeiro.categorias.store') }}';
                    type = 'POST';
                }
                else {

                    let id = $('#table-categorias').find('tr.active').eq(0).text();

                    url = '{{  url('admin/categorias') }}' + '/' + id;
                    type = 'PATCH';
                }

                let centro_id = $("#centro_id").val();
                let nome = $("#categoria_nome").val();
                let fluxo = $("#categoria_fluxo:checked").val();

                $.ajax({
                    type: type,
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: type,
                        nome: nome,
                        centro_id: centro_id,
                        fluxo: fluxo,
                    },
                    success: function (data) {

                        let alertType;

                        (data['title'] == '{{__('views.admin.notify.success')}}') ? alertType = 'green' : alertType = 'red';

                        $('#modal-categoria').modal('toggle');

                        $.alert({
                            backgroundDismiss: true,
                            type: alertType,
                            typeAnimated: true,
                            title: data['title'],
                            content: data['message'],
                        });

                        $("#categoria_nome").val('');

                        $("#categoria_update").attr('disabled', true);
                        $("#categoria_delete").attr('disabled', true);

                        $('#table-categorias').DataTable().draw(false);
                    },
                    error: function () {

                        $.alert({
                            backgroundDismiss: true,
                            type: 'red',
                            typeAnimated: true,
                            title: '{{__('views.admin.notify.error')}}',
                            content: '{{ __('views.admin.notify.error.message') }}',
                        });
                    }
                });
            }
        });

        $('#categoria_delete').on('click', function () {

            $.confirm({
                backgroundDismiss: true,
                type: 'blue',
                typeAnimated: true,
                title: '{{__('views.admin.notify.confirm')}}',
                content: '{{__('views.admin.cc.categoria.delete.confirm')}}',
                buttons: {
                    '{{__('views.admin.button.confirm')}}': {
                        btnClass: 'btn-primary',
                        action: function () {

                            let id = $("#table-categorias").find('tr.active').find('td:eq(0)').text();
                            let url = '{{  url('admin/categorias') }}' + '/' + id;
                            let type = 'DELETE';

                            $.ajax({
                                type: type,
                                url: url,
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    _method: type,
                                },
                                success: function (data) {

                                    let alertType;

                                    (data['title'] == '{{__('views.admin.notify.success')}}') ? alertType = 'green' : alertType = 'red';

                                    $.alert({
                                        backgroundDismiss: true,
                                        type: alertType,
                                        typeAnimated: true,
                                        title: data['title'],
                                        content: data['message'],
                                    });

                                    $('#categoria_nome').val('');
                                    $('#categoria_fluxo').val('1');

                                    $("#categoria_update").attr('disabled', true);
                                    $("#categoria_delete").attr('disabled', true);

                                    $('#table-categorias').DataTable().draw(false);
                                },
                                error: function () {

                                    $.alert({
                                        backgroundDismiss: true,
                                        type: 'red',
                                        typeAnimated: true,
                                        title: '{{__('views.admin.notify.error')}}',
                                        content: '{{ __('views.admin.notify.error.message') }}',
                                    });
                                }
                            });
                        }
                    },
                    '{{__('views.admin.button.cancel')}}': {}
                }
            });
        });

        $('#modal-categoria').on('shown.bs.modal', function () {

            $("#categoria_nome").focus();
        });

        $(document).on('keydown', "input[aria-controls='table-categorias']", function () {

            if ($("#categoria_update").attr('disabled') != 'disabled' && $("#categoria_delete").attr('disabled') != 'disabled') {
                $("#categoria_update").attr('disabled', true);
                $("#categoria_delete").attr('disabled', true);
            }
        });

    });
</script>