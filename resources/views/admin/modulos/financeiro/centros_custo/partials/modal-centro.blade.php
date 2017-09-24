{!! Form::open(['id' => 'form-centro', 'data-parsley-validate']) !!}

{!! Form::hidden('centro_operation', null, ['id' => 'centro_operation'] ) !!}
<div id="modal-centro" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="fa fa-institution fa-fw"></span> Centro de Custo</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label('centro_nome', 'Nome:', ['class' => 'control-label']) !!}
                            {!! Form::text('centro_nome', null, ['id' => 'centro_nome', 'class' => 'form-control', 'required' => 'required']) !!}
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