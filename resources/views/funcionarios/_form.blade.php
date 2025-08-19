@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                   id="nome" name="nome" value="{{ old('nome', $funcionario->nome ?? '') }}" required>
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" value="{{ old('email', $funcionario->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('cpf') is-invalid @enderror" 
                   id="cpf" name="cpf" value="{{ old('cpf', $funcionario->cpf ?? '') }}" 
                   maxlength="11" pattern="[0-9]{11}" required>
            <div class="form-text">Apenas números, 11 dígitos</div>
            @error('cpf')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control @error('telefone') is-invalid @enderror" 
                   id="telefone" name="telefone" value="{{ old('telefone', $funcionario->telefone ?? '') }}">
            @error('telefone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control @error('nascimento') is-invalid @enderror" 
                   id="nascimento" name="nascimento" 
                   value="{{ old('nascimento', isset($funcionario->nascimento) ? $funcionario->nascimento->format('Y-m-d') : '') }}">
            @error('nascimento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="admissao" class="form-label">Data de Admissão</label>
            <input type="date" class="form-control @error('admissao') is-invalid @enderror" 
                   id="admissao" name="admissao" 
                   value="{{ old('admissao', isset($funcionario->admissao) ? $funcionario->admissao->format('Y-m-d') : '') }}">
            @error('admissao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('cargo') is-invalid @enderror" 
                   id="cargo" name="cargo" value="{{ old('cargo', $funcionario->cargo ?? '') }}" required>
            @error('cargo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('departamento') is-invalid @enderror" 
                   id="departamento" name="departamento" value="{{ old('departamento', $funcionario->departamento ?? '') }}" required>
            @error('departamento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                <option value="1" {{ old('status', $funcionario->status ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
                <option value="0" {{ old('status', $funcionario->status ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                   id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/gif">
            <div class="form-text">JPG, PNG até 2MB</div>
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            @if(isset($funcionario) && $funcionario->foto)
                <div class="mt-2">
                    <img src="{{ $funcionario->photo_url }}" alt="Foto atual" 
                         class="img-thumbnail" style="max-width: 100px;">
                    <br><small class="text-muted">Foto atual</small>
                </div>
            @endif
        </div>
    </div>
</div>
