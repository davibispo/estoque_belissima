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
        $existe = DB::table('produtos')
                        ->select('codigo')
                        ->where('ativo', '1')
                        ->where('codigo',$request->codigo)
                        ->where('quantidade', '>', 0)
                        ->exists();
        //dd($request->codigo);
        
        if($existe == true){

            $produtoId = DB::table('produtos')->select('id')->where('codigo', $request->codigo)->value('id');
            $produtoValor = DB::table('produtos')->select('valor')->where('codigo', $request->codigo)->value('valor');

            $venda = new Venda();
            $venda->produto_id = $produtoId;
            $venda->preco = $produtoValor;
            $venda->data_venda = date("Y-m-d H:i:s");
            $venda->user_id = auth()->user()->id;
            $venda->cesta = 0;
    
            //decrementa uma unidade
            DB::table('produtos')->where('codigo', $request->codigo)->decrement('quantidade', 1);
    
            $venda->save();
    
            return back();
        }else{
            return redirect()->back()->with('alertDanger', 'Produto não encontrado!');
        }
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

        $vendas = Venda::all()->where('ativo', '1')->where('status', '1');
        $valorTotal = 0;
        //soma o valor dos produtos
        foreach($vendas as $venda){

            if($venda->status == '1' && $venda->ativo == '1'){
                $valorTotal += $venda->preco;
            }    
            
        }
        
        DB::table('vendas')->where('ativo','1')->where('status','1')->update(['status'=> '2']);
        DB::table('vendas')->where('ativo','1')->where('status','2')->increment('cesta', 1);

        return view('vendas.concluir-venda', compact('vendas', 'valorTotal'));
    }

    //Impressao do comprovante
    public function impressao(){
        
        $vendas = Venda::all()->where('ativo', 1)->where('cesta', 1);
        $produtos = Produto::all()->where('ativo', '1');

        return view('vendas.impressao', compact('vendas','produtos'));
    }

    //Troco
    public function troco(Request $request){
        //dd($request);
        $recebido = $request->valor_recebido;
        $valorTotal = $request->valorTotal;

        $troco = $recebido - $valorTotal;

        //dd($troco);
        
        return view('vendas.troco', compact('valorTotal', 'recebido','troco'));
    }
}
