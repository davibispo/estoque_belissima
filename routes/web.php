<?php

Route::post('vendas/troco', 'VendaController@troco')->name('vendas.troco');

Route::get('vendas/impressao', 'VendaController@impressao')->name('vendas.impressao');
Route::get('vendas/concluir-venda', 'VendaController@concluirVenda')->name('vendas.concluir-venda');

Route::get('relatorios/periodo', 'RelatorioController@periodo')->name('relatorios.periodo');
Route::post('relatorios/periodo', 'RelatorioController@periodo');

Route::get('relatorios/resumido', 'RelatorioController@resumido')->name('relatorios.resumido');
Route::post('relatorios/resumido', 'RelatorioController@resumido');


Route::resource('relatorios', 'RelatorioController');


Route::resource('vendas', 'VendaController');

Route::resource('produtos', 'ProdutoController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
