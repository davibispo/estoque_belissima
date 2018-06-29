<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relatorio;
use App\Venda;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function geral()
    {
        $vendas = Venda::all()->where('ativo', '1')->where('status', '2')->sortByDesc('data_venda');

        return view('relatorios.geral', compact('vendas'));
    }

    public function resumoDiario()
    {
        $vendas = Venda::all()->where('ativo', '1')->where('status', '2')->sortByDesc('data_venda');

        $dataVenda = DB::table('vendas')
                            ->select('data_venda')
                            ->where('ativo','1')
                            ->where('status','2')
                            ->value('venda_data');
                            
        $numProdVendidos = DB::table('vendas')
                            ->select('id')
                            ->where('ativo','1')
                            ->where('status','2')
                            ->where('data_venda', $dataVenda)
                            ->count('id');
        
        $totalValor = DB::table('vendas')
                            ->select('preco')
                            ->where('ativo','1')
                            ->where('status','2')
                            ->where('data_venda', $dataVenda)
                            ->sum('preco');
                            

        return view('relatorios.resumo-diario', compact('vendas','dataVenda','numProdVendidos','totalValor'));
    }
   
}
