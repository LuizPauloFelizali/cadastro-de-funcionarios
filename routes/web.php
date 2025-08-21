<?php

use Illuminate\Support\Facades\Route;// para definir rotas
use Illuminate\Support\Facades\Auth;// para rotas de autenticação


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
    

    // rotas CRUD de funcionários
    Route::resource('funcionarios', 'FuncionariosController');// ao acessar as urls de funcionários, o Laravel já mapeia as rotas corretas para as funções do controller
});