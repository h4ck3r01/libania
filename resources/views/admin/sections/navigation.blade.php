<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.dashboard') }}" class="site_title">
                <i class="fa fa-coffee"></i>
                <span>{{ config('app.name') }}</span>
            </a>
        </div>

        <div class="clearfix"></div>
        <div class="separator hidden-small"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ auth()->user()->avatar }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                {{__('views.backend.section.navigation.greeting')}}
                <h2>{{ ucfirst(auth()->user()->name) }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <div class="clearfix"></div>
        <div class="separator hidden-small"></div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> {{__('views.backend.section.navigation.menu_0_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('cadastro.cliente.index') }}">{{__('views.backend.section.navigation.menu_0_2')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('cadastro.fornecedor.index') }}">{{__('views.backend.section.navigation.menu_0_3')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('cadastro.produto.index') }}">{{__('views.backend.section.navigation.menu_0_4')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-gear"></i> {{__('views.backend.section.navigation.menu_1_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('operacional.caixa.index') }}">{{__('views.backend.section.navigation.menu_1_2')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('operacional.movimentacao.index') }}">{{__('views.backend.section.navigation.menu_1_3')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('operacional.compra.index') }}">{{__('views.backend.section.navigation.menu_1_4')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('operacional.estoque.index') }}">{{__('views.backend.section.navigation.menu_1_5')}}</a>
                            </li>

                        </ul>
                    </li>

                    <li><a><i class="fa fa-inbox"></i> {{__('views.backend.section.navigation.menu_2_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('administrativo.produto_x_venda') }}">{{__('views.backend.section.navigation.menu_2_2')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('administrativo.relacao_vendas') }}">{{__('views.backend.section.navigation.menu_2_3')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('administrativo.relacao_compras') }}">{{__('views.backend.section.navigation.menu_2_4')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users') }}">{{__('views.backend.section.navigation.menu_2_5')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('administrativo.configuracoes_padrao.index') }}">{{__('views.backend.section.navigation.menu_2_6')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-money"></i> {{__('views.backend.section.navigation.menu_3_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('financeiro.centros_custo.index') }}">{{__('views.backend.section.navigation.menu_3_2')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.resumo_centros_custo') }}">{{__('views.backend.section.navigation.menu_3_3')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.pagamentos.index') }}">{{__('views.backend.section.navigation.menu_3_4')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.recebimentos.index') }}">{{__('views.backend.section.navigation.menu_3_5')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.fluxo_caixa') }}">{{__('views.backend.section.navigation.menu_3_6')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.fiado.index') }}">{{__('views.backend.section.navigation.menu_3_7')}}</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="" href="{{ route('logout') }}"
           data-original-title="Logout">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
</div>