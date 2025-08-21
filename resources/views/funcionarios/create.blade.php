@extends('layouts.app')

@section('title', 'Novo Funcionário')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Cadastrar Novo Funcionário</h1>

</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('funcionarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @include('funcionarios._form')
            
            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    Salvar
                </button>
                <a href="{{ route('funcionarios.index') }}" class="btn btn-danger">
                    Cancelar
                </a>
                <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
