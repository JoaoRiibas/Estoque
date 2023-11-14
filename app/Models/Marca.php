<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function getVinculoProduto()
    {
        return DB::connection()->table('produtos')
            ->where('marca_id', $this->id)
            ->count();
    }
}
