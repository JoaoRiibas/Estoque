<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id', 
        'marca_id', 
        'fornecedor_id', 
        'nome', 
        'created_by',
        'descricao',
        'unidade_medida',
        'vl_custo',
        'vl_venda',
        'info_nutricional',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function detalhes()
    {
        return $this->hasOne(ProdutoDetalhe::class);
    }
    
}
