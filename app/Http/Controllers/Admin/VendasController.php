<?php

namespace App\Http\Controllers\Admin;


use App\FiadoPessoa;
use App\Http\Controllers\Controller;
use App\Pessoa;
use App\Produto;
use App\Recebimento;
use App\Venda;
use App\VendaForma;
use App\VendaProduto;
use App\VendasDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VendasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param VendasDatatable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(VendasDatatable $dataTable)
    {
        return $dataTable->render('admin.modulos.operacional.venda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::orderBy('nome')->pluck('nome', 'id')->all();

        $formas = VendaForma::pluck('nome', 'id')->all();

        $pessoas = Pessoa::where('tipo_id', 1)->orderBy('nome')->pluck('nome', 'id')->all();

        return view('admin.modulos.operacional.venda.create', compact('produtos', 'formas', 'pessoas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {

            $venda = Venda::create($request->only('pessoa_id', 'data', 'forma_id', 'desconto', 'total'));

            if ($request->forma_id != 4) {

                $recebimento['pessoa_id'] = $venda->pessoa_id;
                $recebimento['venda_id'] = $venda->id;
                $recebimento['categoria_id'] = 1;
                $recebimento['data'] = $request->data;
                $recebimento['total'] = $request->total;
                $recebimento['forma_id'] = $request->forma_id;

                Recebimento::create($recebimento);
            } else {

                $fiado = FiadoPessoa::wherePessoaId($venda->pessoa_id)->firstOrFail();
                $total = $fiado->total + $request->total;
                $fiado->update(['total' => $total]);
            }

            $estoque = new EstoqueProdutosController();

            foreach ($request['produtos'] as $produto) {
                $produto_venda['venda_id'] = $venda->id;
                $produto_venda['produto_id'] = $produto['produto_id'];
                $produto_venda['quantidade'] = $produto['produto_quantidade'];
                $produto_venda['total'] = $produto['produto_total'];

                VendaProduto::create($produto_venda);

                $estoque->venda($produto['produto_id'], $produto['produto_quantidade'], 'insert');
            }
        });

        return ['status' => 'sucesso', 'title' => __('views.admin.notify.success'), 'message' => __('views.admin.venda.create.success.message')];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $venda = Venda::findOrFail($id);

        return view('admin.modulos.operacional.venda.show', compact('venda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::transaction(function () use ($id) {

            $produtos = VendaProduto::where('venda_id', $id)->get();

            if ($produtos->count() > 0) {

                $estoque = new EstoqueProdutosController();

                foreach ($produtos as $produto) {

                    $estoque->venda($produto['produto_id'], $produto['quantidade'], 'delete');
                }
            }

            $venda = Venda::findOrFail($id);

            if ($venda->forma_id == 4) {

                $fiado = FiadoPessoa::wherePessoaId($venda->pessoa_id)->firstOrFail();
                $total = formatMoney($fiado->total) - formatMoney($venda->total);
                $fiado->update(['total' => $total]);
            }

            $venda->delete();

        });

        Session::flash('deleted', __('views.admin.flash.deleted'));

        return redirect(route('operacional.venda.index'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function produtoAttributes(Request $request)
    {

        $produto = Produto::findOrFail($request->id);

        return response()->json($produto);

    }
}