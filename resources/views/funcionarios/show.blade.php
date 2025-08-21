@extends('layouts.app')

@section('title', 'Detalhes do Funcionário')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Detalhes do Funcionário</h1>
</div>

<div class="card">
    <div class="card-header">
        <h5>Informações do Funcionário</h5>
    </div>
    <div class="card-body">
        @if($funcionario->foto)
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Foto:</strong></div>
            <div class="col-sm-9">
                <img src="{{ asset('uploads/funcionarios/' . $funcionario->foto) }}" alt="Foto do funcionário" 
                     class="img-thumbnail" style="max-width: 150px;">
            </div>
        </div>
        @endif
        
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Nome:</strong></div>
            <div class="col-sm-9">{{ $funcionario->nome }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Email:</strong></div>
            <div class="col-sm-9">{{ $funcionario->email }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-3"><strong>CPF:</strong></div>
            <div class="col-sm-9">{{ $funcionario->cpf }}</div>
        </div>
        
        @if($funcionario->telefone)
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Telefone:</strong></div>
            <div class="col-sm-9">{{ $funcionario->telefone }}</div>
        </div>
        @endif
        
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Cargo:</strong></div>
            <div class="col-sm-9">{{ $funcionario->cargo }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Departamento:</strong></div>
            <div class="col-sm-9">{{ $funcionario->departamento }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Status:</strong></div>
            <div class="col-sm-9">
                @if($funcionario->status)
                    <span class="badge bg-success">Ativo</span>
                @else
                    <span class="badge bg-danger">Inativo</span>
                @endif
            </div>
        </div>
        
        @if($funcionario->nascimento)
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Data de Nascimento:</strong></div>
            <div class="col-sm-9">{{ $funcionario->nascimento->format('d/m/Y') }}</div>
        </div>
        @endif
        
        @if($funcionario->admissao)
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Data de Admissão:</strong></div>
            <div class="col-sm-9">{{ $funcionario->admissao->format('d/m/Y') }}</div>
        </div>
        @endif
        
        <div class="row mb-3">
            <div class="col-sm-3"><strong>Cadastrado em:</strong></div>
            <div class="col-sm-9">{{ $funcionario->created_at->format('d/m/Y H:i') }}</div>
        </div>
    </div>
</div>

<div class="mt-4">
    <div class="d-flex gap-2">
        <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-warning">
            Editar
        </a>
        <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                
                Excluir
            </button>
        </form>
        <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</div>
@endsection
