<?php

Route::get('vendas/concluir-venda', 'VendaController@concluirVenda')->name('vendas.concluir-venda');

Route::resource('vendas', 'VendaController');

Route::get('relatorios/geral', 'RelatorioController@geral')->name('relatorios.geral');

Route::get('relatorios/resumido', 'RelatorioController@resumido')->name('relatorios.resumido');

Route::resource('produtos', 'ProdutoController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
