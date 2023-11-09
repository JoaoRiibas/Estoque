<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'descricao', 
        'unidade_medida', 
        'vl_custo', 
        'vl_venda', 
        'info_nutricional'
    ];
}
