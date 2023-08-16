<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pessoa extends Model
{
    use HasFactory;

    const CLASSIFICACAO = [
        1 => 'Ouro',
        2 => 'Ouro',
        3 => 'Prata',
    ];


    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'categoria_id'
    ];


    public function categoria() : HasOne
    {
        return $this->hasOne(Categoria::class,'id','categoria_id');
    }
}
