<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'descricao', 
        'foto_path'
    ];

    public function getVinculoProduto()
    {
        return DB::connection()->table('produtos')
            ->where('categoria_id', $this->id)
            ->count();
    }
}
