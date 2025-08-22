<?php

use Illuminate\Support\Facades\Route;// para definir rotas
use Illuminate\Support\Facades\Auth;// para rotas de autenticação


Auth::routes();// cria todas as rotas de autenticação

Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
   
   
   
    // Rota home protegida
    Route::get('/home', function() {
        return redirect()->route('funcionarios.index');
    })->name('home');
    

    // rotas CRUD de funcionários, cruda = create, read, update, delete
    Route::resource('funcionarios', 'FuncionariosController');// ao acessar as urls de funcionários, o Laravel já mapeia as rotas corretas para as funções do controller
    //usuario acessa /funcionarios/5/edit, o Laravel chama a função edit do controller FuncionariosController com o id 5
});