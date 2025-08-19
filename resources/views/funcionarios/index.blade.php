@extends('layouts.app')

@section('title', 'Funcionários')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-users me-2"></i>Funcionários</h1>
    <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Novo Funcionário
    </a>
</div>

@if($funcionarios->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Cargo</th>
                            <th>Departamento</th>
                            <th>Status</th>
                            <th width="280px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($funcionarios as $funcionario)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($funcionario->foto)
                                        <img src="{{ $funcionario->photo_url }}" alt="Foto" 
                                             class="rounded-circle me-2" width="40" height="40">
                                    @else
                                        <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                    {{ $funcionario->nome }}
                                </div>
                            </td>
                            <td>{{ $funcionario->email }}</td>
                            <td>{{ $funcionario->cargo }}</td>
                            <td>{{ $funcionario->departamento }}</td>
                            <td>
                                @if($funcionario->status)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-danger">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('funcionarios.show', $funcionario->id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('funcionarios.edit', $funcionario->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Tem certeza que deseja excluir?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-users fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">Nenhum funcionário cadastrado</h4>
        <p class="text-muted">Clique no botão "Novo Funcionário" para começar.</p>
    </div>
@endif
@endsection
