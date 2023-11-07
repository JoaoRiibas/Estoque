<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class FornecedorController extends Controller
{
    public function index(Builder $builder)
    {
    
        if(request()->ajax()){
            $fornecedores = Fornecedor::query();
            
            return DataTables::of($fornecedores)
                ->addColumn('action', function($fornecedor){
                    return view('fornecedor.action', [
                        'fornecedor' => $fornecedor
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome', 'class'=> 'text-semibold'],
            ['data' => 'cnpj', 'name' => 'cnpj', 'title' => 'CNPJ', 'class'=> 'text-semibold'],
            ['data' => 'telefone', 'name' => 'telefone', 'title' => 'Telefone', 'class'=> 'text-semibold'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Ações', 'class'=> 'col-md-2'],
        ]);

        return view('fornecedor.index', compact('html'));
    }

    public function form($id = 0)
    {
        $fornecedor = $id > 0 ? Fornecedor::findOrFail($id) : new Fornecedor;

        return view('fornecedor.form', compact('fornecedor'));
    }

    public function store(Request $request, $id = 0)
    {
        dd($request->all());
    }
}
