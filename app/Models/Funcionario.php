<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model 
{

    protected $table = 'funcionarios'; // define o nome da tabela associada ao modelo

    protected $fillable = [// campos que podem ser preenchidos de uma vez
        'nome','email','cpf','telefone','nascimento','admissao',
        'cargo','departamento','status','foto',
    ];

    protected $dates = [// campos que devem ser tratados como datas
        'nascimento',
        'admissao',
        'created_at',
        'updated_at',
        'deleted_at', // campo para soft delete
    ];

    protected $appends = ['photo_url'];
    
    public function getPhotoUrlAttribute()
    {
        return $this->foto ? asset('uploads/funcionarios/'.$this->foto) : null;
    }

    use SoftDeletes;

}