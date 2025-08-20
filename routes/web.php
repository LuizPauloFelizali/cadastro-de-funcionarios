<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Rotas de autenticação (fora do middleware)
Auth::routes();

Route::get('/', function () {
    return redirect()->route('register');
});

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
   
   
   
    // Rota home protegida
    Route::get('/home', function() {
        return redirect()->route('funcionarios.index');
    })->name('home');
    

    // Rotas CRUD de funcionários
    Route::resource('funcionarios', 'FuncionariosController');
});