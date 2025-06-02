<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $nome = 'Matheus';
    $idade = 29;

    $arr = [1,2,3,4,5];

    $nomes = ["taylor", "julia", "luiz", "paty"];
    
    return view('welcome', 
    [
        'nome' => $nome,
        'idade' => $idade,
        'profissao' => "programador",
        'arr' => $arr,
        'nomes' => $nomes
    ]);
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/episodios', function () {

    $busca = request('search');
    return view('episodes', ['busca' => $busca]);
});

Route::get('/episodio/{id}', function ($id) {
    return view('episode', ['id' => $id]);
});
