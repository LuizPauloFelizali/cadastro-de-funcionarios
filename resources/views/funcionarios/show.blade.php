@extends('layouts.app')

@section('title', 'Detalhes do Funcionário')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user me-2"></i>Detalhes do Funcionário</h1>
    <div>
        <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Editar
        </a>
        <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($funcionario->foto)
                    <img src="{{ $funcionario->photo_url }}" alt="Foto do Funcionário" 
                         class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                @else
                    <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 200px; height: 200px;">
                        <i class="fas fa-user fa-5x text-white"></i>
                    </div>
                @endif
                
                <h4>{{ $funcionario->nome }}</h4>
                <p class="text-muted">{{ $funcionario->cargo }}</p>
                
                @if($funcionario->status)
                    <span class="badge bg-success fs-6">Ativo</span>
                @else
                    <span class="badge bg-danger fs-6">Inativo</span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informações Pessoais</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Nome:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->nome }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Email:</strong></div>
                    <div class="col-sm-8">
                        <a href="mailto:{{ $funcionario->email }}">{{ $funcionario->email }}</a>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>CPF:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->cpf }}</div>
                </div>
                
                @if($funcionario->telefone)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Telefone:</strong></div>
                    <div class="col-sm-8">
                        <a href="tel:{{ $funcionario->telefone }}">{{ $funcionario->telefone }}</a>
                    </div>
                </div>
                @endif
                
                @if($funcionario->nascimento)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Data de Nascimento:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->nascimento->format('d/m/Y') }}</div>
                </div>
                @endif
                
                @if($funcionario->admissao)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Data de Admissão:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->admissao->format('d/m/Y') }}</div>
                </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Informações Profissionais</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Cargo:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->cargo }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Departamento:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->departamento }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Status:</strong></div>
                    <div class="col-sm-8">
                        @if($funcionario->status)
                            <span class="badge bg-success">Ativo</span>
                        @else
                            <span class="badge bg-danger">Inativo</span>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Cadastrado em:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->created_at->format('d/m/Y H:i') }}</div>
                </div>
                
                @if($funcionario->updated_at != $funcionario->created_at)
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Atualizado em:</strong></div>
                    <div class="col-sm-8">{{ $funcionario->updated_at->format('d/m/Y H:i') }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <div class="d-flex gap-2">
        <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Editar
        </a>
        <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" 
                    onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">
                <i class="fas fa-trash me-2"></i>Excluir
            </button>
        </form>
        <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
            <i class="fas fa-list me-2"></i>Ver Todos
        </a>
    </div>
</div>
@endsection
