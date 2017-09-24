{!! Form::open(['id' => 'form-categoria', 'data-parsley-validate']) !!}

{!! Form::hidden('categoria_operation', null, ['id' => 'categoria_operation'] ) !!}
{!! Form::hidden('centro_id', null, ['id' => 'centro_id'] ) !!}
<div id="modal-categoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="fa fa-institution fa-fw"></span> Categoria</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label('categoria_centro', 'Centro de Custo:', ['class' => 'control-label']) !!}
                            {!! Form::text('categoria_centro', null, ['id' => 'categoria_centro', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label('categoria_nome', 'Nome:', ['class' => 'control-label']) !!}
                            {!! Form::text('categoria_nome', null, ['id' => 'categoria_nome', 'class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6">
                        {!! Form::label('categoria_fluxo', __('views.admin.movimento.fluxo'), ['class' => 'control-label']) !!}
                        <br/>

                        <label class="radio-inline">
                            {!!  Form::radio('categoria_fluxo', '1', true); !!}
                            {{ __("views.admin.cc.fluxo_1") }}
                        </label>
                        <label class="radio-inline">
                            {!!  Form::radio('categoria_fluxo', '2', false); !!}
                            {{ __("views.admin.cc.fluxo_2") }}
                        </label>

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