<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venda;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendas = Venda::all()->where('ativo', '1')->where('status', '2')->sortByDesc('data_venda');
        $numProdutosVendidos = DB::table('vendas')->where('ativo','1')->where('status','2')->count('id');
        $valorTotal = DB::table('vendas')->where('ativo','1')->where('status','2')->sum('preco');

        return view('relatorios.index', compact('vendas','numProdutosVendidos','valorTotal','total'));
    }

    public function resumido(Request $request){

        
        $data = $request->data;
        
        $vendas = Venda::all()->where('ativo', '1')->where('status', '2')->where('data_venda', $data)->sortByDesc('data_venda');
        
        $numProdutosVendidos = DB::table('vendas')->where('ativo','1')->where('status','2')->where('data_venda', $data)->count('id');
        
        $valorTotal = DB::table('vendas')->where('ativo','1')->where('status','2')->where('data_venda', $data)->sum('preco');

        return view('relatorios.resumido', compact('vendas','numProdutosVendidos','valorTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$total = DB::table('vendas')->whereBetween('data_venda', [$dataInicio, $dataFim])->sum('preco');
        $vendas = Venda::all()->where('ativo','1')->where('status','2');
        return view('relatorios.create', compact('vendas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;

        //valor das vendas entre duas datas
        //dd($total);                      
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


