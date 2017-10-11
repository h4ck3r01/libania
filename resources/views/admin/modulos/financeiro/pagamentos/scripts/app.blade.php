<script>

    $(document).ready(function () {

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
                {
                    data: 'pagamento',
                    name: 'pagamentos.pagamento',
                    className: 'text-center',
                    width: '10%',
                    'searchable': false
                },
                {data: 'categoria.nome', name: 'categoria.nome', width: '20%'},
                {data: 'pessoa.nome', name: 'pessoa.nome', width: '40%', defaultContent: ''},
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

    });
</script>