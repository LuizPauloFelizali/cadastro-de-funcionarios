@extends('layouts.app')

@section('title', 'Novo Funcionário')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-plus me-2"></i>Novo Funcionário</h1>
    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('funcionarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @include('funcionarios._form')
            
            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-2"></i>Salvar
                </button>
                <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Máscara para CPF
    document.getElementById('cpf').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });
</script>
@endsection
