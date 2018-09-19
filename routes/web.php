<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contato', 'ContatoController@index');
Route::post('/contato/enviar', 'ContatoController@enviar');



Route::resource('/produtos', 'ProdutosController');

Route:: post('produtos/busca', 'ProdutosController@busca');

Route::post('/produtos/ordem', 'ProdutosController@ordem');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

