<script>
    $(document).ready(function () {

        let count = 0;
        let count_max = 99;

        function getProdutoPreco(id, input) {

            let url = '{{  route('operacional.compra.produto.preco') }}';

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id: id
                },
                success: function (data) {

                    (data > 0) ? input.val(data) : input.val('');
                },
                error: function (xhr) {
                    alert(xhr.responseText);
                },
            });

        }

        function calcTotal(){

            let subtotal = formatMoney($('#subtotal').val());
            let desconto = formatMoney($('#desconto').val());
            let juros = formatMoney($('#juros').val());

            let total = (subtotal - desconto) + juros;

            if (total < 0)
                total = 0;

            $('#total').val(total);
        }

        $("#add").on('click', function () {

            count++;

            $('#' + count).removeClass('hidden');

            if (count == count_max)
                $(this).attr('disabled', true);

        });

        $('#form-delete').on('submit', function (e, done) {

            if (!done) {
                e.preventDefault();

                $.confirm({
                    backgroundDismiss: true,
                    type: 'blue',
                    typeAnimated: true,
                    title: '{{__('views.admin.notify.confirm')}}',
                    content: '{{__('views.admin.compra.delete.confirm')}}',
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

        $('.quantidade, .preco').on('change', function () {

            let id = $(this).prop('name').match(/\[([^[]*)\]/)[1];

            let quantidade = $("input[name='quantidade[" + id + "]']").val();
            let preco = $("input[name='preco[" + id + "]']").val();

            let produto_total = quantidade * formatMoney(preco);

            $("input[name='produto_total[" + id + "]']").val(produto_total);

            let total = 0;

            $('.produto_total:visible').each(function () {
                if ($(this).val() != '') {
                    total += formatMoney($(this).val());
                }
            });

            $('#subtotal').val(total);

            calcTotal();

        });

        $('.produto').on('change', function () {

            let id = $(this).prop('name').match(/\[([^[]*)\]/)[1];

            if ($(this).val() != '') {

                $("input[name='quantidade[" + id + "]']").prop('required', true);
                $("input[name='preco[" + id + "]']").prop('required', true);
            }
            else {
                $("input[name='quantidade[" + id + "]']").prop('required', false);
                $("input[name='preco[" + id + "]']").prop('required', false);
            }

            let input = $("input[name='preco[" + id + "]']");

            getProdutoPreco($(this).val(), input);
        });

        $('#desconto, #juros').on('blur', function () {

            calcTotal();
        });

    });
</script>