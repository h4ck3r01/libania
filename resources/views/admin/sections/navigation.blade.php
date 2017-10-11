<div class="col-md-3 left_col menu_fixed">
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
        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>{{__('views.backend.section.navigation.sub_header_0')}}</h3>
                <ul class="nav side-menu">
                    <li class="{{activeMenu(['pessoa', 'produto'])}}">
                        <a><i class="fa fa-edit"></i> {{__('views.backend.section.navigation.menu_0_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="{{blockMenu(['pessoa', 'produto'])}}">
                            <li class="{{currentMenu(['pessoa'])}}">
                                <a href="{{ route('cadastro.pessoa.index') }}">{{__('views.backend.section.navigation.menu_0_2')}}</a>
                            </li>
                            <li class="{{currentMenu(['produto'])}}">
                                <a href="{{ route('cadastro.produto.index') }}">{{__('views.backend.section.navigation.menu_0_3')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{activeMenu(['venda', 'movimento', 'compra', 'estoque'])}}">
                        <a><i class="fa fa-gear"></i> {{__('views.backend.section.navigation.menu_1_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="{{blockMenu(['venda', 'movimento', 'compra', 'estoque'])}}">
                            <li class="{{currentMenu(['venda'])}}">
                                <a href="{{ route('operacional.venda.index') }}">{{__('views.backend.section.navigation.menu_1_2')}}</a>
                            </li>
                            <li class="{{currentMenu(['movimento'])}}">
                                <a href="{{ route('operacional.movimento.index') }}">{{__('views.backend.section.navigation.menu_1_3')}}</a>
                            </li>
                            <li class="{{currentMenu(['compra'])}}">
                                <a href="{{ route('operacional.compra.index') }}">{{__('views.backend.section.navigation.menu_1_4')}}</a>
                            </li>
                            <li class="{{currentMenu(['estoque'])}}">
                                <a href="{{ route('operacional.estoque.index') }}">{{__('views.backend.section.navigation.menu_1_5')}}</a>
                            </li>

                        </ul>
                    </li>

                    <li><a><i class="fa fa-inbox"></i> {{__('views.backend.section.navigation.menu_2_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('administrativo.relacao_produtos') }}">{{__('views.backend.section.navigation.menu_2_2')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('administrativo.relacao_vendas') }}">{{__('views.backend.section.navigation.menu_2_3')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('administrativo.relacao_compras') }}">{{__('views.backend.section.navigation.menu_2_4')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-money"></i> {{__('views.backend.section.navigation.menu_3_1')}}
                            <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('financeiro.centros_custo.index') }}">{{__('views.backend.section.navigation.menu_3_2')}}</a>
                            </li>
                            <!--<li>
                                <a href="{{ route('financeiro.resumo_centros_custo') }}">{{__('views.backend.section.navigation.menu_3_3')}}</a>
                            </li>-->
                            <li>
                                <a href="{{ route('financeiro.pagamentos.index') }}">{{__('views.backend.section.navigation.menu_3_4')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.recebimentos.index') }}">{{__('views.backend.section.navigation.menu_3_5')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.caixa.index') }}">{{__('views.backend.section.navigation.menu_3_6')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('financeiro.fiado.index') }}">{{__('views.backend.section.navigation.menu_3_7')}}</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            @if(Auth::user()->hasRole('administrator'))
                <div class="menu_section">
                    <h3>{{__('views.backend.section.navigation.sub_header_1')}}</h3>
                    <ul class="nav side-menu">
                        <li>
                            <a href="{{ route('admin.users') }}"><i
                                        class="fa fa-user"></i> {{__('views.backend.section.navigation.menu_4_0')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('configuracao.configuracao.index') }}"><i
                                        class="fa fa-wrench"></i> {{__('views.backend.section.navigation.menu_4_1')}}
                            </a>
                        </li>
                    </ul>
                </div>
            @endif

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