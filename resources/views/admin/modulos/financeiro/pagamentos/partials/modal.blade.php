{!! Form::open(['id' => 'form-pagamento', 'data-parsley-validate']) !!}

{!! Form::hidden('pagamento_operation', null, ['id' => 'pagamento_operation'] ) !!}
{!! Form::hidden('pagamento_id', null, ['id' => 'pagamento_id'] ) !!}
<div id="modal-pagamento" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="fa fa-money fa-fw"></span> Pagamento</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-xs-8 col-md-6 col-lg-4">
                        {!! Form::label('vencimento', __('views.admin.pagamentos.vencimento'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span></span>
                            {!! Form::date('vencimento', null, ['id' => 'vencimento', 'class' => 'form-control', 'required' => 'required', 'data-parsley-required-message' => "",]) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-8 col-md-6 col-lg-4">
                        {!! Form::label('categoria_id', __('views.admin.pagamentos.categoria'), ['class' => 'control-label']) !!}
                        {!! Form::select('categoria_id',
                                [
                                    ''  =>  __('views.admin.select.default'),
                                ] + $categorias,
                                null,
                                [
                                    'id' => 'categoria_id',
                                    'class' => 'form-control select2',
                                    'required' => 'required',
                                    'data-parsley-required-message' => "",
                                ]
                            ) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-8 col-md-6 col-lg-4">
                        {!! Form::label('pessoa_id', __('views.admin.pagamentos.pessoa'), ['class' => 'control-label']) !!}
                        {!! Form::select('pessoa_id',
                                [
                                    ''  =>  __('views.admin.select.default'),
                                ] + $pessoas,
                                null,
                                [
                                    'id' => 'pessoa_id',
                                    'class' => 'form-control select2',
                                    'data-parsley-required-message' => "",
                                ]
                            ) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-8 col-md-6 col-lg-4">
                        {!! Form::label('pagamento_total', __('views.admin.pagamentos.total'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            {!! Form::tel('pagamento_total', 0, [
                                'id' => 'pagamento_total',
                                'class' => 'form-control money',
                                'required' => 'required',
                                ]
                            ) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-12 col-sm-8 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('obs', __('views.admin.pagamentos.obs'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('obs', null, [
                                                            'id' => 'obs',
                                                            'class' => 'form-control',
                                                            'rows'=>3,
                                                            'required' => 'required',
                                                            ]
                            ) !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div clas="row">
                    <div class="col-xs-offset-8 col-xs-2">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary col-xs-12']) !!}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::button('Cancelar', ['class' => 'btn btn-default col-xs-12', 'data-dismiss' => 'modal']) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{!! Form::close() !!}