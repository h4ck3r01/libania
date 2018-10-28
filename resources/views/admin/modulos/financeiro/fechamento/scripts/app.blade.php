<script>

    $(document).ready(function () {

        let table_fechamento_dinheiro = $("#table-fechamento-dinheiro");
        let table_fechamento_cartao = $("#table-fechamento-cartao");

        table_fechamento_dinheiro.DataTable({
            processing: true,
            serverSide: true,
            order: [[2, 'desc'], ['1', 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('financeiro.ajax.table-fechamento-dinheiro')!!}',
                data: function (d) {
                    d.data = $("#data_inicial").val()
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
                $("#recebimentos_dinheiro_hidden").val(json.sum);
                var sum = parseMoney(JSON.parse(json.sum));

                $("#total_recebimentos_dinheiro").html('{{__("views.admin.recebimentos.index.footer")}}' + sum);
            }
        });

        table_fechamento_cartao.DataTable({
            processing: true,
            serverSide: true,
            order: [[2, 'desc'], ['1', 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('financeiro.ajax.table-fechamento-cartao')!!}',
                data: function (d) {
                    d.data = $("#data_inicial").val()
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
                $("#recebimentos_cartao_hidden").val(json.sum);
                var sum = parseMoney(JSON.parse(json.sum));

                $("#total_recebimentos_cartao").html('{{__("views.admin.recebimentos.index.footer")}}' + sum);
            }
        });

        let table_fechamento_pagamentos = $("#table-fechamento-pagamentos");

        table_fechamento_pagamentos.DataTable({
            processing: true,
            serverSide: true,
            order: [[2, 'desc'], ['1', 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('financeiro.ajax.table-fechamento-pagamentos')!!}',
                data: function (d) {
                    d.data = $("#data_inicial").val()
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

        $('#data_inicial').on('change', function () {

            table_fechamento_dinheiro.DataTable().ajax.reload();
            table_fechamento_cartao.DataTable().ajax.reload();
            table_fechamento_pagamentos.DataTable().ajax.reload();
        });

        $("#porcentagem").on('change', function () {

            var total = formatMoney($("#total").val());

            var porcentagem = $(this).val();

            var reserva = (total / 100) * porcentagem;

            var lucro = total - reserva;

            $("#reserva").val(reserva);

            $("#lucro").val(lucro);
        });

        /*$(document).ajaxStop(function () {

            var total = $("#recebimentos_dinheiro_hidden").val() - $("#pagamentos_hidden").val();

            $("#total").val(total);

            var url = '';
            var type = 'GET';

            $.ajax({
                type: type,
                url: url,
                data: function (d) {
                    d.data = $("#data_inicial").val()
                },
                success: function (data) {

                },
                error: function () {

                }
            });
        });*/

    });
</script>