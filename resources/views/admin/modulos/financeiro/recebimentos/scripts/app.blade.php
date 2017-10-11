<script>

    $(document).ready(function () {

        let table = $("#table-recebimentos");

        $('#data_inicial, #data_final, #categoria, #cliente, #forma').on('change', function () {
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
                url: '{!!  route('financeiro.ajax.table-recebimentos')!!}',
                data: function (d) {
                    d.data_inicial = $("#data_inicial").val(),
                        d.data_final = $("#data_final").val(),
                        d.categoria = $("#categoria option:selected").val(),
                        d.cliente = $("#cliente option:selected").val(),
                        d.forma = $("#forma option:selected").val()
                }
            },
            columns: [
                {data: 'id', name: 'recebimentos.id', className: 'hidden'},
                {data: 'venda_id', name: 'recebimentos.venda_id', className: 'text-center', width: '10%'},
                {data: 'data', name: 'recebimentos.data', className: 'text-center', width: '10%', 'searchable': false},
                {data: 'categoria.nome', name: 'categoria.nome', width: '20%'},
                {data: 'forma.nome', name: 'forma.nome', width: '20%'},
                {data: 'pessoa.nome', name: 'pessoa.nome', width: '30%', defaultContent: ''},
                {data: 'recebimentos.total', name: 'recebimentos.total', className: 'text-right', width: '10%'}
            ],
            fnDrawCallback: function () {

                var api = this.api();
                var json = api.ajax.json();
                var sum = parseMoney(JSON.parse(json.sum));

                $("#total").html('{{__("views.admin.recebimentos.index.footer")}}' + sum);
            }
        });

    });
</script>