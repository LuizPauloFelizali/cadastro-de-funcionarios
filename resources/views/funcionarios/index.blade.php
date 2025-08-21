@extends('layouts.app')

@section('title', 'Funcionários')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Lista de Funcionários</h1>
    
    <div class="d-flex gap-2"> 
        <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
            Novo Funcionário
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">
                Sair
            </button>
        </form>
    </div>
</div>

@if($funcionarios->count() > 0)
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Ver Mais</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $funcionario->nome }}</td>
                        <td>{{ $funcionario->email }}</td>
                        <td>{{ $funcionario->cargo }}</td>
                        <td>
                            <a href="{{ route('funcionarios.show', $funcionario->id) }}" 
                               class="btn btn-info btn-sm">+</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="text-center py-5">
        <h4>Nenhum funcionário cadastrado</h4>
    </div>
@endif
@endsection
