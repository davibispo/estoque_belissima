<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relatorio;
use App\Venda;

class RelatorioController extends Controller
{
    public function geral()
    {

        $vendas = Venda::all()->where('ativo', '1')->where('status', '2')->sortByDesc('data_venda');

        return view('relatorios.geral', compact('vendas'));
    
    }

    public function resumido()
    {

        return view('relatorios.geral');
    
    }
   
}
