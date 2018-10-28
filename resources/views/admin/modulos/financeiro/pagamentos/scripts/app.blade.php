<script>

    $(document).ready(function () {

        function clearPagamento() {

            $('#vencimento').val('');
            $('#pessoa_id').val('').trigger('change');
            $('#categoria_id').val('');
            $('#pagamento_total').val('');

            $('#modal-pagamento').modal('toggle');

            $('#table-pagamentos').DataTable().ajax.reload();
        }

        let table = $("#table-pagamentos");

        $('#data_inicial, #data_final, #categoria, #fornecedor').on('change', function () {
            table.DataTable().ajax.reload();
        });

        table.DataTable({
            processing: true,
            serverSide: true,
            order: [[2, 'desc'], ['1', 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('financeiro.ajax.table-pagamentos')!!}',
                data: function (d) {
                    d.data_inicial = $("#data_inicial").val(),
                        d.data_final = $("#data_final").val(),
                        d.categoria = $("#categoria option:selected").val(),
                        d.fornecedor = $("#fornecedor option:selected").val()
                }
            },
            columns: [
                {data: 'id', name: 'pagamentos.id', className: 'hidden'},
                {data: 'compra_id', name: 'pagamentos.compra_id', className: 'text-center', width: '10%'},
                {
                    data: 'vencimento',
                    name: 'pagamentos.vencimento',
                    className: 'text-center',
                    width: '10%',
                    'searchable': false
                },
                /*{
                    data: 'pagamento',
                    name: 'pagamentos.pagamento',
                    className: 'text-center',
                    width: '10%',
                    'searchable': false
                },*/
                {data: 'categoria.nome', name: 'categoria.nome', width: '10%'},
                {data: 'pessoa.nome', name: 'pessoa.nome', width: '25%', defaultContent: ''},
                {data: 'obs', name: 'pagamentos.obs', width: '25%', defaultContent: ''},
                {data: 'pagamentos.total', name: 'pagamentos.total', className: 'text-right', width: '10%'},
                {data: 'total', name: 'sum', className: 'hidden'}
            ],
            fnDrawCallback: function () {

                var api = this.api();
                var json = api.ajax.json();
                var sum = parseMoney(JSON.parse(json.sum));

                $("#total").html('{{__("views.admin.pagamentos.index.footer")}}' + sum);
            }
        });

        $('#form-pagamento').on('submit', function (e) {

            e.preventDefault();

            if ($(this).parsley().isValid()) {

                let url = '{{  route('financeiro.pagamentos.store') }}';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        vencimento: $("#vencimento").val(),
                        pessoa_id: $("#pessoa_id option:selected").val(),
                        categoria_id: $("#categoria_id option:selected").val(),
                        total: formatMoney($("#pagamento_total").val()),
                        obs: $("#obs").val(),
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

                        clearPagamento();
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

    })
</script>