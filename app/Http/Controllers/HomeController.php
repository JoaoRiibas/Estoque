<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $categorias = Categoria::all()->toArray();

        return view('home.index', compact('categorias'));
    }

    public function listagem($id)
    {
        $categoria = Categoria::findOrFail($id);

        $query = "
            WITH sum_estoque as (
                SELECT distinct
                    l1.id,
                    case when e1.operacao = false 
                        then sum(e1.qtd_produto)
                    end as entrada,
                    case when e1.operacao = true 
                        then sum(e1.qtd_produto)
                    end as saida, 
                    l1.cod_lote
                FROM estoques as e1
                join produtos p1 on p1.id = e1.produto_id
                join lotes l1 on l1.id = e1.lote_id
                where categoria_id = {$id} 
                group by l1.id, e1.operacao
            )
            SELECT 
                max(se.entrada) as entrada,
                max(se.saida) as saida,
                l.cod_lote,
                l.id,
                l.validade,
                p.nome
            FROM ESTOQUES e
            join produtos p on p.id = e.produto_id
            join lotes l on l.id = e.lote_id
            join sum_estoque se on se.id = l.id
            where categoria_id = {$id}
            group by l.id, p.nome";

        $produtos = DB::select($query);

        $array = [];

        foreach($produtos as $key => $produto){
            if(isset($array[$produto->nome])){

                $array[$produto->nome][] = [
                    'validade' => $produto->validade,
                    'lote' => $produto->cod_lote,
                    'entrada' => $produto->entrada,
                    'saida' => $produto->saida
                ];

            }else{
                
                $array[$produto->nome][] = [
                    'validade' => $produto->validade,
                    'lote' => $produto->cod_lote,
                    'entrada' => $produto->entrada,
                    'saida' => $produto->saida
                ];
            }
        }

        $array_total = [];

        foreach($array as $k => $a){
            $prod = Produto::where('nome', $k)->first();
            $array_total [$k] = $prod->getQuantidadeProduto();
        }
        
        return view('home.listagem', compact('categoria', 'array', 'array_total'));
    }
}
