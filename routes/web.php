<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpisodeController;

//home
Route::get('/', [EpisodeController::class, 'home'])->name('home');
 
//lista de eps
Route::get('/episodios', [EpisodeController::class, 'index'])->name('episodes.index');

//ep em especifico
Route::get('/episodio/{episode:slug}', [EpisodeController::class, 'show'])->name('episodes.show');

//eps por categoria
Route::get('/categoria/{category:slug}', [EpisodeController::class, 'byCategory'])->name('episodes.category');

//eps por tag
Route::get('/tag/{tag:slug}', [EpisodeController::class, 'byTag'])->name('episodes.tag');

//ROTAS ESTÁTICAS
Route::view('/sobre', 'pages.about')->name('about');
Route::view('/contato', 'pages.contact')->name('contact');