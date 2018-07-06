<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Relatorio;
use Illuminate\Support\Facades\DB;
use App\User;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all()->where('ativo', '1')->sortByDesc('id');

        $qdtProdutos = DB::table('produtos')->where('ativo','1')->count('id');

        return view('produtos.index', compact('produtos','qdtProdutos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Produto();

        $p->codigo = $request->codigo;
        $p->nome = strtoupper($request->nome);
        $p->valor = str_replace(',','.',$request->valor); //caso use vírgula será substituido por ponto.
        $p->descricao = strtoupper($request->descricao);
        $p->quantidade = $request->quantidade;
        $p->user_id = auth()->user()->id;

        $p->save();

        return redirect()->route('produtos.index')->with('alertSuccess', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produtos.update', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        $produto->codigo = $request->codigo;
        $produto->nome = strtoupper($request->nome);
        $produto->valor = str_replace(',','.',$request->valor);
        $produto->descricao = strtoupper($request->descricao);
        $produto->quantidade = $request->quantidade;
        $produto->user_id = auth()->user()->id;
        
        $produto->update();
        
        return redirect()->route('produtos.index')->with('alertSuccess', 'Dados atualizados com sucesso!');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);

        $produto->ativo = '0';
        $produto->update();

        return redirect()->route('produtos.index')->with('alertDanger', 'Item excluído com sucesso!');
    }

    public function venda($id, Request $request)
    {
        $produto = Produto::find($id);
        if($request->quantidade == 1){
            $produto->quantidade -= 1;
        }
        $produto->update();

        return redirect()->route('produtos.index')->with('alertSuccess', 'Item vendido com sucesso!');
    }
}
