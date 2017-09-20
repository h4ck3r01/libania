<script>

    $(document).ready(function () {

        $('.select2').select2({
            tags: false,
            width: '100%',
        });

        $('#produto').on('change', function () {

            let url = '{{  route('operacional.venda.produto.attributes') }}';

            let id = $("option:selected", this).val();

            if (id != '') {

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        id: id
                    },
                    success: function (data) {

                        $('#valor').val(data['preco']);

                        $('#quantidade').val('');

                        $('#quantidade').focus();

                        $("#add").prop("disabled", false);

                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert(xhr.responseText);
                    },
                });

            }
            else {

                $('#quantidade').val('');
                $('#valor').val('');
                $("#add").prop("disabled", true);
            }

        });

        $("#form-add").on('submit', function (e) {

            e.preventDefault();

            if ($(this).parsley().isValid()) {

                let produto_id = $('#produto').val();
                let produto_nome = $('#produto option:selected').text();
                let produto_quantidade = $('#quantidade').val();
                let produto_valor = formatMoney($('#valor').val());

                let produto_total = produto_valor * produto_quantidade;

                let desconto = formatMoney($("#desconto").val());
                let subtotal = formatMoney($('#subtotal').val()) + produto_total;
                let total = subtotal - desconto;

                $("#subtotal").val(subtotal);
                $("#total").val(total);

                $('#table-produtos tbody').append(
                    `<tr>
                    <td class='hidden'>
                        ` + produto_id + `
                    </td>
                    <td width='60%'>
                        ` + produto_nome + `
                    </td>
                    <td width='10%' class='text-center'>
                        ` + produto_quantidade + `
                    </td>
                    <td width='20%' class='text-right'>
                        ` + parseMoney(produto_total) + `
                    </td>
                    <td width='10%'class='text-center'>
                        <a class='btn btn-xs btn-danger produto_delete'><i class="fa fa-times-circle"></i></a>
                    </td>
                </tr>`
                );

                $('#produto').val('').trigger('change');
                $('#quantidade').val('');
                $('#valor').val('');

                $("#finalizar").attr('disabled', false);
            }

        });

        $(document).on('click', '.produto_delete', function () {

            let produto_total = formatMoney($.trim($(this).closest('tr').children('td:eq(3)').text()));
            let desconto = formatMoney($("#desconto").val());
            let subtotal = formatMoney($('#subtotal').val()) - produto_total;
            let total = subtotal - desconto;

            $("#subtotal").val(subtotal);

            if (total < 0)
                total = 0;

            $("#total").val(total);

            $(this).closest('tr').remove();

            if ($("#table-produtos tbody").children().length == 0)
                $('#finalizar').attr('disabled', true);

        });

        $('#desconto').on('blur', function () {

            let desconto = formatMoney($(this).val());
            let subtotal = formatMoney($('#subtotal').val());

            let total = subtotal - desconto;

            if (total < 0)
                total = 0;

            $('#total').val(total);

        });

        $('#form-finalizar').on('submit', function (e) {

            e.preventDefault();

            if ($(this).parsley().isValid()) {

                let produtos = [];

                $('#table-produtos > tbody > tr').each(function () {
                    let produto_id = $.trim($(this).find('td:eq(0)').text());
                    let produto_quantidade = $.trim($(this).find('td:eq(2)').text());
                    let produto_total = formatMoney($.trim($(this).find('td:eq(3)').text()));

                    produtos.push({
                        'produto_id': produto_id,
                        'produto_quantidade': produto_quantidade,
                        'produto_total': produto_total
                    });

                });

                let total = formatMoney($('#total').val());
                let desconto = formatMoney($('#desconto').val());
                let forma_id = $('#forma_id').val();

                let url = '{{  route('operacional.venda.store') }}';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        produtos: produtos,
                        total: total,
                        desconto: desconto,
                        forma_id: forma_id,
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

                        clearVenda();
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

        function clearVenda() {

            $('#produto').val('').trigger('change');
            $('#quantidade').val('');
            $('#valor').val('');

            $("#subtotal").val('0');
            $("#desconto").val('0');
            $("#total").val('0');
            $("#forma_id").val('');

            $('#div_troco').addClass('hidden');
            $("#recebido").val('0');
            $('#troco').val('0');

            $("#finalizar").attr('disabled', true);

            $('#table-produtos tbody').empty();

            $('#recebido').attr('required', false);
        }

        $('#forma_id').on('change', function () {

            if ($(this).val() == 1) {
                $('#div_troco').removeClass('hidden');
                $('#recebido').attr('required', true);
            }
            else {
                $('#div_troco').addClass('hidden');
                $("#recebido").attr('required', false);
            }
        });

        $('#recebido').on('blur', function () {

            let total = formatMoney($('#total').val());
            let recebido = formatMoney($(this).val());
            let troco = recebido - total;

            if (troco > 0)
                $('#troco').val(troco);
            else
                $('#troco').val('0');
        });

        $('#form-delete').on('submit', function (e, done) {

            if (!done) {
                e.preventDefault();

                $.confirm({
                    backgroundDismiss: true,
                    type: 'blue',
                    typeAnimated: true,
                    title: '{{__('views.admin.notify.confirm')}}',
                    content: '{{__('views.admin.venda.delete.confirm')}}',
                    buttons: {
                        '{{__('views.admin.button.confirm')}}': {
                            btnClass: 'btn-primary',
                            action: function () {
                                $('#form-delete').trigger('submit', {'done': true});
                            }
                        },
                        '{{__('views.admin.button.cancel')}}': {}
                    }
                });
            }
        });

    });

</script>