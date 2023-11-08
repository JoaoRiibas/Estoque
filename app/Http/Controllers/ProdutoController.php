<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class ProdutoController extends Controller
{
    public function index(Builder $builder)
    {
        
        $html = $builder
            ->parameters([
                'order' => [[0, 'desc']],
                'autoWidth' => false
            ])->columns([
                ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome'],
                ['data' => 'marca.nome', 'name' => 'marca.nome', 'title' => 'Marca'],
                ['data' => 'categoria.nome', 'name' => 'categoria.nome', 'title' => 'Categoria'],
                ['data' => 'fornecedor.nome', 'name' => 'fornecedor.nome', 'title' => 'Fornecedor'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Criado Em'],
                ['data' => 'criado_por', 'name' => 'criado_por', 'title' => 'Responsável'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Opções', 'searchable' => false, 'class' => 'td-actions']
            ])->ajax([
                'url' => route('produto.filter'),
                'type' => 'POST',
                'data' => 'function(d){
                        d._token = "' . csrf_token() . '"
                }',
            ]);

        return view('produto.index', compact('html'));
        
    }

    public function filter(Request $request)
    {
        $produtos = Produto::query()->with(['categoria', 'marca', 'fornecedor']);

        return DataTables::of($produtos)
            ->addColumn('action', 'produto.action')
            ->editColumn('created_at', function($produto){
                return $produto->created_at->format('d/m/Y');
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function form($id = 0)
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function delete($id)
    {
        
    }

    public function detalhes($id)
    {
        
    }
}
