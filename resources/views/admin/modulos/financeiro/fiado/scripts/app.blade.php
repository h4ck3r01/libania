<script>

    $(document).ready(function () {

        let table_1 = $("#table-fiado-vendas");

        table_1.DataTable({
            dom: 'tip',
            processing: true,
            serverSide: true,
            order: [['0', 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('financeiro.ajax.table-fiado-vendas')!!}',
                data: function (d) {
                    d.id = $("#pessoa_id").val();
                }
            },
            columns: [
                {data: 'id', name: 'vendas.id', className: 'text-center', width: '25%'},
                {data: 'data', name: 'vendas.data', className: 'text-center', width: '25%', 'searchable': false},
                {data: 'vendas.desconto', name: 'vendas.desconto', className: 'text-right', width: '25%'},
                {data: 'vendas.total', name: 'vendas.total', className: 'text-right', width: '25%'},
            ]
        });

        let table_2 = $("#table-fiado-recebimentos");

        table_2.DataTable({
            dom: 'tip',
            processing: true,
            serverSide: true,
            order: [['0', 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('financeiro.ajax.table-fiado-recebimentos')!!}',
                data: function (d) {
                    d.id = $("#pessoa_id").val();
                }
            },
            columns: [
                {data: 'data', name: 'recebimentos.data', className: 'text-center', width: '25%', 'searchable': false},
                {data: 'forma.nome', name: 'forma.nome', width: '25%'},
                {data: 'recebimentos.total', name: 'recebimentos.total', className: 'text-right', width: '25%'},
                {data: 'action', name: 'action', className: 'text-center', width: '10%', orderable: false, searchable: false, printable: false, exportable: false}
            ]
        });

    });
</script>