<?php

Route::get('/postagens', 'PostagensController@index');
Route::get('/postagens/usuario', 'PostagensController@postagensUsuario');
Route::get('/postagens/criar', 'PostagensController@create');
Route::post('/postagens/criar', 'PostagensController@store');
Route::delete('/postagens/remover/{id}', 'PostagensController@destroy');
Route::post('postagens/editar/{id}','PostagensController@change');
Route::put('postagens/editado/{id}','PostagensController@update');
Route::get('postagens/editado/{id}','PostagensController@update');
Route::get('postagens/editar/{id}','PostagensController@change');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sair', function () {
    
    Auth::logout();
    return redirect('/login');
});

Route::get('/', function () {
    
    return redirect('/home');
});
