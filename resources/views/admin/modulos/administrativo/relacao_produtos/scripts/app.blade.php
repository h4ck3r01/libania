<script>
    $(document).ready(function () {

        let table = $("#table-relacao-produtos");

        $('#data_inicial, #data_final, #categoria').on('change', function () {
            table.DataTable().ajax.reload();
        });

        table.DataTable({
            dom: 'Bftip',
            processing: true,
            serverSide: true,
            order: [[0, 'asc'], [1, 'asc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
            },
            ajax: {
                type: 'GET',
                url: '{!!  route('administrativo.ajax.table-relacao-produtos')!!}',
                data: function (d) {
                    d.data_inicial = $("#data_inicial").val(),
                        d.data_final = $("#data_final").val(),
                        d.categoria = $("#categoria option:selected").val()
                }
            },
            columns: [
                {data: 'id', name: 'produtos.id', className: 'text-center', width: '10%'},
                {data: 'nome', name: 'produtos.nome', width: '10%'},
                {data: 'categoria', name: 'categoria', width: '10%'},
                {data: 'venda_quantidade', name: 'venda_quantidade', className: 'text-center', width: '10%'},
                {data: 'venda_total', name: 'venda_total', className: 'text-center', width: '10%'},
                {data: 'compra_quantidade', name: 'compra_quantidade', className: 'text-center', width: '10%'},
                {data: 'compra_total', name: 'compra_total', className: 'text-center', width: '10%'},
                {data: 'lucro', name: 'lucro', className: 'text-center', width: '10%'},
            ],
            buttons: [
                {
                    extend: 'excel',
                    className: 'form-control',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    exportOptions: {
                        modifier: {
                            order: 'current',
                            page: 'all',
                            search: 'applied'
                        }
                    }
                },
                {
                    'extend': 'print',
                    'className': 'form-control'
                }
            ]
        });

    });
</script>