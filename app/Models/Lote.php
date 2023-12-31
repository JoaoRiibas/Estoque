<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_lote', 
        'descricao',
        'validade'
    ];

    protected $casts = [
        'validade' => 'datetime:d/m/Y',
    ];
}
