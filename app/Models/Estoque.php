<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id', 
        'lote_id', 
        'validade_produto', 
        'operacao', 
        'local_armazenamento', 
        'qtd_produto', 
        'created_by'
    ];

    protected $casts = [
        'validade_produto'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
    
    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }
}
