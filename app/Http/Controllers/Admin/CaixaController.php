<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CaixaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modulos.financeiro.caixa.index');
    }
}
