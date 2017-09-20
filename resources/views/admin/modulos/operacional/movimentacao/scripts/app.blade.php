<script>
    $(document).ready(function () {

        let count = 0;

        $("#add").on('click', function(){

            count++;

            $('#'+count).removeClass('hidden');

            if(count == 9)
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
                    content: '{{__('views.admin.movimento.delete.confirm')}}',
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