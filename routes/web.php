<?php

Route::get('vendas/concluir-venda', 'VendaController@concluirVenda')->name('vendas.concluir-venda');

Route::get('relatorios/resumido', 'RelatorioController@resumido')->name('relatorios.resumido');
Route::post('relatorios/resumido', 'RelatorioController@resumido');

Route::resource('relatorios', 'RelatorioController');


Route::resource('vendas', 'VendaController');

//Route::get('relatorios/geral', 'RelatorioController@geral')->name('relatorios.geral');
//Route::post('relatorios', 'RelatorioController@resumoDiario');

Route::resource('produtos', 'ProdutoController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
