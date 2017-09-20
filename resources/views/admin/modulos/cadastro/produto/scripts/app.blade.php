<script>
    $(document).ready(function () {

        $('.select2').select2({
            tags: true,
            width: '100%',
            language: 'pt-BR',
        });

        $("#categoria_id").change(function () {

            if ($("#categoria_id").val() !== '') {
                $("#categoria_delete").prop("disabled", false);
            } else {
                $("#categoria_delete").prop("disabled", true);
            }

        });

        $('#categoria_delete').on('click', function () {

            $.confirm({
                backgroundDismiss: true,
                type: 'blue',
                typeAnimated: true,
                title: '{{__('views.admin.notify.confirm')}}',
                content: '{{__('views.admin.produto.categoria.delete.confirm')}}',
                buttons: {
                    '{{__('views.admin.button.confirm')}}': {
                        btnClass: 'btn-primary',
                        action: function () {
                            confirmAction()
                        }
                    },
                    '{{__('views.admin.button.cancel')}}': {}
                }
            });

        });

        function clearCategoria() {
            $('#categoria_id :selected').remove();
            $("#categoria_delete").prop('disabled', true);
        }

        function confirmAction() {

            let id = $('#categoria_id :selected').val();

            if ($.isNumeric(id)) {

                let url = '{{  route('cadastro.produto.categoria.destroy') }}';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (data) {

                        if (data['status'] == 'sucesso') {
                            clearCategoria()
                        }

                        let alertType;

                        (data['title'] == '{{__('views.admin.notify.success')}}') ? alertType = 'green' : alertType = 'red';

                        $.alert({
                            backgroundDismiss: true,
                            type: alertType,
                            typeAnimated: true,
                            title: data['title'],
                            content: data['message'],
                        });
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
            } else {

                clearCategoria();
            }
        }

        $('#form-delete').on('submit', function (e, done) {

            if (!done) {
                e.preventDefault();

                $.confirm({
                    backgroundDismiss: true,
                    type: 'blue',
                    typeAnimated: true,
                    title: '{{__('views.admin.notify.confirm')}}',
                    content: '{{__('views.admin.produto.delete.confirm')}}',
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