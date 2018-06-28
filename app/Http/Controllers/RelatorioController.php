<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relatorio;

class RelatorioController extends Controller
{
    public function geral()
    {

        $relatorios = Relatorio::all()->sortByDesc('data');

        return view('relatorios.geral', compact('relatorios'));
    
    }

    public function analitico()
    {

        $relatorios = Relatorio::all()->sortByDesc('data');

        return view('relatorios.analitico', compact('relatorios'));
    
    }

   
}
