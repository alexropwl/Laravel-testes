<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/contato', 'ContatoController');

Route::resource('/produtos', 'ProdutosController');

Route:: post('produtos/busca', 'ProdutosController@busca');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

