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
        $produtos = Produto::all()->where('ativo', '1')->where('quantidade', '>', 0)->sortByDesc('created_at');
        $vendas = Venda::all()->where('ativo', '1')->where('status', '1');
        $numProdutosNaCesta = DB::table('vendas')->where('ativo', '1')->where('status', '1')->count('id');

        $valorTotal = 0;

        /*
            status = 1 -> Colocando produtos na cesta
            status = 2 -> Produtos vendidos
        */

        //soma o valor dos produtos
        foreach($vendas as $venda){

            if($venda->status == '1' && $venda->ativo == '1'){
                $valorTotal += $venda->preco;
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
        $produtos = Produto::all()->where('ativo', '1')->where('quantidade', '>', 0)->sortBy('nome');
        $vendas = Venda::all()->where('ativo', '1')->where('status', '1');
        $numProdutosNaCesta = DB::table('vendas')->where('ativo', '1')->where('status', '1')->count('id');

        $valorTotal = 0;

        /*
            status = 1 -> Colocando produtos na cesta
            status = 2 -> Produtos vendidos
        */

        //soma o valor dos produtos
        foreach($vendas as $venda){

            if($venda->status == '1' && $venda->ativo == '1'){
                $valorTotal += $venda->preco;
            }    
            
        }

        return view('vendas.create', compact('produtos','vendas','valorTotal','numProdutosNaCesta'));
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
        //
    }

    /**
     * Muda o campo ativo da tabela venda para 0, inativando o mesmo para
     * REMOVER O PRODUTO DA CESTA.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $produto_id)
    {

        $venda = Venda::find($produto_id);
        $venda->ativo = $request->ativo;
       
        //associa o id do produto selecionado ao da tabela de produtos
        $produto = Produto::find($venda->produto_id);

        //incrementa de volta uma unidade na quantidade
        DB::table('produtos')->where('ativo', '1')->where('id', $venda->produto_id)->increment('quantidade', 1);
               
        $venda->update();
        
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($produto_id)
    {
        //
    }

    // Conclui a venda mudando o status para 2 e incrementa 1 em cada cesta anterior.
    public function concluirVenda(){

        DB::table('vendas')->where('ativo','1')->where('status','1')->update(['status'=> '2']);
        DB::table('vendas')->where('ativo','1')->where('status','2')->increment('cesta', 1);
        return redirect()->back()->with('alertSuccess', 'Venda concluída com sucesso!');

    }
}
