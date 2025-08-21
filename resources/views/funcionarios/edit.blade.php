@extends('layouts.app')

@section('title', 'Editar Funcionário')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Editar Funcionário</h1>
    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
        Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @include('funcionarios._form')
            
            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    Atualizar
                </button>
                <a href="{{ route('funcionarios.show', $funcionario->id) }}" class="btn btn-info">
                    Ver Detalhes
                </a>
                <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
