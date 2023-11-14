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

    static $operacao_cor = [
        0 => 'success',
        1 => 'danger'
    ];

    static $operacao_nome = [
        0 => 'ENTRADA',
        1 => 'SAIDA'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
    
    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }

    public function getOperacaoCor()
    {
        return SELF::$operacao_cor[$this->operacao];
    }

    public function getOperacaoNome()
    {
        return SELF::$operacao_nome[$this->operacao];
    }
}
