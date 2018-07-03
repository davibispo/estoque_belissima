<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Venda;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all()->where('ativo', '1')->where('quantidade', '>', 0);

        $vendas = Venda::all()->where('ativo', '1')->where('status', '1');

        $numProdutosNaCesta = DB::table('vendas')->where('ativo', '1')->where('status', '1')->count('id');

        $valorTotal = 0;

        /*
            status = 1 -> Colocando produtos na cesta
            status = 2 -> Produtos vendidos
        */

        //soma o valor dos produtos
        foreach($vendas as $venda){
            foreach($produtos as $produto){
                if($venda->status == 1 && $venda->produto_id == $produto->id && $venda->ativo == '1'){
                    $valorTotal += $produto->valor;
                }    
            }
        }
       
        return view('vendas.index', compact('produtos', 'vendas', 'valorTotal', 'numProdutosNaCesta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venda = new Venda();

        $venda->produto_id = $request->produto_id;
        $venda->preco = $request->preco;
        $venda->data_venda = date("Y-m-d H:i:s");
        $venda->user_id = auth()->user()->id;
        $venda->cesta = 0;

        //associa o id do produto selecionado ao da tabela de produtos
        $produto = Produto::find($request->produto_id);

        //decrementa uma unidade
        DB::table('produtos')->where('id', $request->produto_id)->decrement('quantidade', 1);

        $venda->save();

        return redirect()->back();
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
        $venda = Venda::find($id);

        $vendas = Venda::all()->where('status', '1')->where('ativo', '1');
        
        foreach($vendas as $venda){

            $venda->status = $request->status;
            $venda->user_id = auth()->user()->id;
            
            $venda->update();
        }

        return redirect()->back()->with('alertSuccess', 'Venda concluída com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($produto_id)
    {
        $venda = Venda::find($produto_id);
        $venda->ativo = '0';

        $venda->update();

        return redirect()->back();
    }

    public function concluirVenda(){

        DB::table('vendas')->where('ativo','1')->where('status','1')->update(['status'=> '2']);
        DB::table('vendas')->where('ativo','1')->where('status','2')->increment('cesta',1);
        return redirect()->back()->with('alertSuccess', 'Venda concluída com sucesso!');
    }
}
