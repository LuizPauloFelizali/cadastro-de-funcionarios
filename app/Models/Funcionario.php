<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;// Modelo para a tabela funcionarios
use Illuminate\Database\Eloquent\SoftDeletes;// habilita soft delete

class Funcionario extends Model // Modelo para a tabela funcionarios
{

    protected $table = 'funcionarios'; // conexão com a tabela


    // campos que podem ser preenchidos de uma vez
    protected $fillable = ['nome','email','cpf','telefone','nascimento','admissao','cargo','departamento','status','foto',];
    


    // campos que devem ser tratados como datas
    protected $dates = ['nascimento','admissao','created_at','updated_at','deleted_at'];
    


    protected $appends = ['photo_url'];// adiciona o atributo photo_url ao modelo para facilitar o acesso à URL da foto do funcionário
    
    public function getPhotoUrlAttribute()// método para obter a URL da foto do funcionário
    {
        return $this->foto ? asset('uploads/funcionarios/'.$this->foto) : null; // retorna a URL da foto se existir, caso contrário retorna null
    }

    use SoftDeletes; //habilita soft delete, permitindo que os registros sejam "excluídos" sem serem removidos do banco de dados

}