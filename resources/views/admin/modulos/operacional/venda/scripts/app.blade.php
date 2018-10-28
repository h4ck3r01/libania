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
                    error: function (xhr) {
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

        $("#forma_id, #forma_id_opcional").change(function () {

            if ($("#forma_id option:selected").val() == 4
                || $("#forma_id_opcional option:selected").val() == 4) {
                $("#pessoa_id").prop('required', true);
            } else {
                $("#pessoa_id").prop('required', false);
                $("#add_forma").prop('disabled', false);
            }

            $('#form-finalizar').parsley().reset();

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
                $("#total_1").val(total);
                $('#total_2').val('0');

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
            $("#total_1").val(total);
            $('#total_2').val('0');

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
            $('#total_1').val(total);
            $('#total_2').val('0');

        });

        $('#form-finalizar').on('submit', function (e) {

                e.preventDefault();

                let total = formatMoney($('#total').val());

                let total_1 = formatMoney($("#total_1").val());
                let total_2 = formatMoney($("#total_2").val());

                let validate = total_1 + total_2;

                if ($(this).parsley().isValid()) {

                    if (total == validate) {

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

                        let pessoa_id = $('#pessoa_id option:selected').val();
                        let data = $('#data').val();
                        let desconto = formatMoney($('#desconto').val());
                        let forma_id = $('#forma_id option:selected').val();
                        let forma_id_opcional = $('#forma_id_opcional option:selected').val();


                        let url = '{{  route('operacional.venda.store') }}';

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                _token: '{{ csrf_token() }}',
                                produtos: produtos,
                                pessoa_id: pessoa_id,
                                data: data,
                                total: total,
                                desconto: desconto,
                                forma_id: forma_id,
                                forma_id_opcional: forma_id_opcional,
                                total_1: total_1,
                                total_2: total_2
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
                    else {
                        $.alert({
                            backgroundDismiss: true,
                            type: 'red',
                            typeAnimated: true,
                            title: '{{__('views.admin.venda.alert.valor.title')}}',
                            content: '{{ __('views.admin.venda.alert.valor.message') }}',
                        });
                    }
                }
            }
        );

        function clearVenda() {

            $('#produto').val('').trigger('change');
            $('#quantidade').val('');
            $('#valor').val('');

            $('#pessoa_id').val('').trigger('change');

            if ($(".forma_id").hasClass('hidden'))
                $(".forma_id").removeClass('hidden');

            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();

            var data = d.getFullYear() + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                (day < 10 ? '0' : '') + day;

            $("#data").val(data);
            $("#subtotal").val('0');
            $("#desconto").val('0');
            $("#total").val('0');

            $("#forma_id").val('');
            $("#total_1").val('');

            $("#forma_id_opcional").val('');
            $("#total_2").val('');

            $("#forma_2").addClass("hidden");
            $("#forma_id_opcional").prop('required', false);
            $("#total_2").prop('required', false);

            $("#remove_forma_div").addClass("hidden");
            $("#add_forma_div").removeClass("hidden");

            $("#finalizar").attr('disabled', true);

            $('#table-produtos tbody').empty();

        }

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

        $("#add_forma").on('click', function () {

            $("#forma_2").removeClass("hidden");
            $("#add_forma_div").addClass("hidden");
            $("#remove_forma_div").removeClass("hidden");
            $("#forma_id_opcional").prop('required', true);
            $("#total_2").prop('required', true);

            calcTotal_2();
        });

        $("#remove_forma").on('click', function () {

            $("#forma_2").addClass("hidden");
            $("#remove_forma_div").addClass("hidden");
            $("#add_forma_div").removeClass("hidden");
            $("#forma_id_opcional").val('');
            $("#forma_id_opcional").prop('required', false);
            $("#total_2").val('0');
            $("#total_2").prop('required', false);

            calcTotal_1();
        });

        $("#total_1").on('change', function () {

            if (!$("#forma_2").hasClass("hidden")) {

                calcTotal_2();
            }
        });

        $("#total_2").on('change', function () {

            calcTotal_1();
        });

        function calcTotal_1() {

            let total = formatMoney($("#total").val());
            let total_2 = formatMoney($("#total_2").val());

            let total_1 = total - total_2;

            $("#total_1").val(total_1);
        }


        function calcTotal_2() {

            let total = formatMoney($("#total").val());
            let total_1 = formatMoney($("#total_1").val());

            let total_2 = total - total_1;

            $("#total_2").val(total_2);
        }

    });

</script>