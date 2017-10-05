<script>

    $(document).ready(function () {

        let table = $("#table-recebimentos");

        $('#data_inicial, #data_final').on('change', function () {
            table.DataTable().ajax.reload();
        });

        table.DataTable({
            processing: true,
            serverSide: true,
            order: [[2, 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('financeiro.ajax.table-recebimentos')!!}',
                data: function (d) {
                    d.data_inicial = $("#data_inicial").val(),
                        d.data_final = $("#data_final").val()
                }
            },
            columns: [
                {data: 'id', name: 'recebimentos.id', className: 'hidden'},
                {data: 'venda_id', name: 'recebimentos.venda_id', className: 'text-center', width: '10%'},
                {data: 'data', name: 'recebimentos.data', className: 'text-center', width: '10%', 'searchable': false},
                {data: 'categoria.nome', name: 'categoria.nome', width: '20%'},
                {data: 'pessoa.nome', name: 'pessoa.nome', width: '50%', defaultContent: ''},
                {data: 'recebimentos.total', name: 'recebimentos.total', className: 'text-right', width: '10%'},
                {data: 'total', name: 'sum', className: 'hidden'}
            ],
            initComplete: function () {

                let categoria_column = this.api().columns(3);
                let cliente_column = this.api().columns(4);

                $('#categoria')
                    .on('change', function () {

                        filter($(this).val(), categoria_column);
                    });

                $('#cliente')
                    .on('change', function () {

                        filter($(this).val(), cliente_column);
                    });
            },
            fnDrawCallback: function () {

                var total = $("#table-recebimentos").DataTable().column(6, {"page": "applied"}).data().sum();

                $("#total").html('{{__("views.admin.recebimentos.index.footer")}}' + parseMoney(total));
            }
        });

    });
</script>