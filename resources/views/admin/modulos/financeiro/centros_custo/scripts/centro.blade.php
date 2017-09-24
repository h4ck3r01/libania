<script>
    $(document).ready(function () {

        function categoriasDatatable(id) {

            let url = '{!!  route('financeiro.ajax.table-categorias', array(':id'))!!}';
            url = url.replace(':id', id);

            if (!$.fn.dataTable.isDataTable('#table-categorias')) {
                $('#table-categorias').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    serverSide: true,
                    order: [[1, 'asc']],
                    buttons: [],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
                    },
                    ajax: url,
                    columns: [
                        {data: 'id', name: 'financeiro_categorias.id', className: 'text-center', width: '10%'},
                        {data: 'nome', name: 'financeiro_categorias.nome'},
                        {data: 'fluxo', name: 'financeiro_categorias.fluxo'},
                    ],
                });
            }
            else {
                $('#table-categorias').DataTable().ajax.url(url).load();
            }
        }

        $('#table-centros tbody').on('click', 'tr', function () {

            $(this).toggleClass('active').siblings().removeClass('active');

            if ($(this).hasClass('active')) {
                $("#centro_update").attr('disabled', false);
                $("#centro_deletedelete").attr('disabled', false);
                $("#categoria_insert").attr('disabled', false);

                let id = $(this).find('td').eq(0).text();
                let nome = $(this).find('td').eq(1).text();

                $('#centro_nome').val(nome);

                $('#centro_id').val(id);
                $('#categoria_centro').val(nome);

                categoriasDatatable(id);
            }
            else {
                $("#centro_update").attr('disabled', true);
                $("#centro_delete").attr('disabled', true);
                $("#categoria_insert").attr('disabled', true);
                $("#categoria_update").attr('disabled', true);
                $("#categoria_delete").attr('disabled', true);

                $('#table-categorias tbody tr').remove();

                $('#table-categorias tbody').append(`
                <tr>
                    <td colspan="3" class="text-center">
                        {{ __('views.admin.cc.index.table_2.default') }}
                    </td>
                </tr>
                `);
            }


        });

        $("#centro_insert").on('click', function () {
            $('#centro_nome').val('');
            $("#centro_operation").val('insert');
        });

        $("#centro_update").on('click', function () {
            $("#centro_operation").val('update');
        });

        $('#form-centro').on('submit', function (e) {

            e.preventDefault();

            if ($(this).parsley().isValid()) {

                let operation = $("#centro_operation").val();

                let url, type;

                if (operation == 'insert') {
                    url = '{{  route('financeiro.centros_custo.store') }}';
                    type = 'POST';
                }
                else {

                    let id = $('#table-centros').find('tr.active').eq(0).text();

                    url = '{{  url('admin/centros_custo') }}' + '/' + id;
                    type = 'PATCH';
                }

                let centro_nome = $("#centro_nome").val();

                $.ajax({
                    type: type,
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: type,
                        nome: centro_nome,
                    },
                    success: function (data) {

                        let alertType;

                        (data['title'] == '{{__('views.admin.notify.success')}}') ? alertType = 'green' : alertType = 'red';

                        $('#modal-centro').modal('toggle');

                        $.alert({
                            backgroundDismiss: true,
                            type: alertType,
                            typeAnimated: true,
                            title: data['title'],
                            content: data['message'],
                        });

                        $("#centro_nome").val('');

                        $("#centro_update").attr('disabled', true);
                        $("#centro_delete").attr('disabled', true);
                        $("#categoria_insert").attr('disabled', true);
                        $("#categoria_update").attr('disabled', true);
                        $("#categoria_delete").attr('disabled', true);

                        $('#table-categorias tbody tr').remove();

                        $('#table-categorias tbody').append(`
                                                            <tr>
                                                                <td colspan="3" class="text-center">
                                                                    {{ __('views.admin.cc.index.table_2.default') }}
                                                                </td>
                                                            </tr>
                                                            `);

                        $('#table-centros').DataTable().draw(false);
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

        $('#centro_delete').on('click', function () {

            $.confirm({
                backgroundDismiss: true,
                type: 'blue',
                typeAnimated: true,
                title: '{{__('views.admin.notify.confirm')}}',
                content: '{{__('views.admin.cc.delete.confirm')}}',
                buttons: {
                    '{{__('views.admin.button.confirm')}}': {
                        btnClass: 'btn-primary',
                        action: function () {

                            let id = $("#table-centros").find('tr.active').find('td:eq(0)').text();
                            let url = '{{  url('admin/centros_custo') }}' + '/' + id;
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

                                    $("#centro_nome").val('');

                                    $("#centro_update").attr('disabled', true);
                                    $("#centro_delete").attr('disabled', true);

                                    $('#table-centros').DataTable().draw(false);
                                },
                                error: function (xhr) {

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

    });
</script>