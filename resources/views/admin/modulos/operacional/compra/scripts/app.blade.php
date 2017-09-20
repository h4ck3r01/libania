<script>
    $(document).ready(function () {

        let count = 0;

        $("#add").on('click', function () {

            count++;

            $('#' + count).removeClass('hidden');

            if (count == 9)
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

            $('#total').val(total);

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

        });

    });
</script>