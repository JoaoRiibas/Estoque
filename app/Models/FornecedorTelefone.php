<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FornecedorTelefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedor_id', 
        'numero',
        'is_whatsapp'
    ];
 
}
