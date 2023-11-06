<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'cnpj', 
        'telefone'
    ];

    public function telefones()
    {
        return $this->hasMany(FornecedorTelefone::class);
    }

    public function endereco()
    {
        return $this->hasOne(FornecedorEndereco::class);
    }
}
