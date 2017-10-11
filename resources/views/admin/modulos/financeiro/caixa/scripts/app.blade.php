<script>

    $(document).ready(function () {

        let table_recebimentos = $("#table-recebimentos");

        table_recebimentos.DataTable({
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
                        d.data_final = $("#data_final").val()
                }
            },
            columns: [
                {data: 'id', name: 'recebimentos.id', className: 'hidden'},
                {data: 'venda_id', name: 'recebimentos.venda_id', className: 'text-center', width: '10%'},
                {data: 'data', name: 'recebimentos.data', className: 'text-center', width: '10%', 'searchable': false},
                {data: 'categoria.nome', name: 'categoria.nome', width: '20%'},
                {data: 'forma.nome', name: 'forma.nome', width: '20%'},
                {data: 'pessoa.nome', name: 'pessoa.nome', width: '40%', defaultContent: ''},
                {data: 'recebimentos.total', name: 'recebimentos.total', className: 'text-right', width: '10%'}
            ],
            fnDrawCallback: function () {

                var api = this.api();
                var json = api.ajax.json();
                $("#recebimentos_hidden").val(json.sum);
                var sum = parseMoney(JSON.parse(json.sum));

                $("#total_recebimentos").html('{{__("views.admin.recebimentos.index.footer")}}' + sum);
            }
        });

        let table_pagamentos = $("#table-pagamentos");

        $('#data_inicial, #data_final').on('change', function () {
            table_pagamentos.DataTable().ajax.reload();
        });

        table_pagamentos.DataTable({
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
                        d.data_final = $("#data_final").val()
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
                $("#pagamentos_hidden").val(json.sum);
                var sum = parseMoney(JSON.parse(json.sum));

                $("#total_pagamentos").html('{{__("views.admin.pagamentos.index.footer")}}' + sum);
            }
        });

        $('#data_inicial, #data_final').on('change', function () {

            table_recebimentos.DataTable().ajax.reload();
            table_pagamentos.DataTable().ajax.reload();
        });

        $(document).ajaxStop(function () {

            var total = $("#recebimentos_hidden").val() - $("#pagamentos_hidden").val();

            $("#total").val(total);
        });

    });
</script>