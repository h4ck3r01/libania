<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * default
 */
Route::get('/', 'admin\DashboardController@index');

/**
 * Auth routes
 */
Route::group(['namespace' => 'Auth'], function () {

    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    if (config('auth.users.registration')) {
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
    }

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');

    // Confirmation Routes...
    if (config('auth.users.confirm_email')) {
        Route::get('confirm/{user_by_code}', 'ConfirmController@confirm')->name('confirm');
        Route::get('confirm/resend/{user_by_email}', 'ConfirmController@sendEmail')->name('confirm.send');
    }
});

/**
 * Backend routes
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //Users
    Route::get('users', 'UserController@index')->name('users');
    Route::get('users/{user}', 'UserController@show')->name('users.show');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
    Route::get('permissions', 'PermissionController@index')->name('permissions');
    Route::get('permissions/{user}/repeat', 'PermissionController@repeat')->name('permissions.repeat');
    Route::get('dashboard/log-chart', 'DashboardController@getLogChartData')->name('dashboard.log.chart');
    Route::get('dashboard/registration-chart', 'DashboardController@getRegistrationChartData')->name('dashboard.registration.chart');
});

Route::group(['prefix' => 'admin', 'as' => 'cadastro.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::resource('cliente', 'ClienteController');
    Route::resource('fornecedor', 'FornecedorController');
    Route::resource('produto', 'ProdutoController');

    Route::get('datatable/cliente', 'ClienteController@getDatatable')->name('datatable.cliente');
    Route::get('datatable/fornecedor', 'FornecedorController@getDatatable')->name('datatable.fornecedor');

});

Route::group(['prefix' => 'admin', 'as' => 'operacional.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::resource('caixa', 'VendaController');
    Route::resource('movimento', 'MovimentoController');
    Route::resource('compra', 'CompraController');
    Route::resource('estoque', 'EstoqueProdutoController');

});

Route::group(['prefix' => 'admin', 'as' => 'administrativo.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('produto_x_venda', 'AdminController@productSale')->name('produto_x_venda');
    Route::get('relacao_vendas', 'AdminController@salesRelation')->name('relacao_vendas');
    Route::get('relacao_compras', 'AdminController@purchasesRelation')->name('relacao_compras');
    Route::resource('configuracoes_padrao', 'ConfigController');

});

Route::group(['prefix' => 'admin', 'as' => 'financeiro.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::resource('centros_custo','FinanceiroCentroController');
    Route::get('resumo_centros_custo','FinanceiroCentroController@resumo')->name('resumo_centros_custo');
    Route::get('fluxo_caixa','VendaController@fluxo')->name('fluxo_caixa');
    Route::resource('recebimentos','RecebimentosController');
    Route::resource('pagamentos','PagamentosController');
    Route::resource('fiado','FiadoClienteController');

});