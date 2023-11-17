<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getQuantidadeProduto()
    {
        $entrada = DB::connection()->table('estoques')
            ->where('produto_id', $this->id)
            ->where('operacao', 0)
            ->sum('qtd_produto');

        $saida = DB::connection()->table('estoques')
            ->where('produto_id', $this->id)
            ->where('operacao', 1)
            ->sum('qtd_produto');

        $quantidade = $entrada - $saida;
        
        return $quantidade;
    }

    public function getLotes(){
        
        $lotes = DB::connection()->table('estoques as e')
            ->join('lotes as l', 'l.id', 'e.lote_id')
            ->where('produto_id', $this->id)
            ->get();

        return $lotes;
    }
    
}
