<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Rota para a página inicial
Route::get('/', function () {
    return redirect()->route('funcionarios.index');
});

// Rotas de autenticação
Auth::routes();

// Rota home  após login
Route::get('/home', function() {
    return redirect()->route('funcionarios.index');
})->name('home');

// Rotas para o CRUD de funcionários (protegidas por auth)
Route::middleware(['auth'])->group(function () {
    Route::resource('funcionarios', 'FuncionariosController');
});