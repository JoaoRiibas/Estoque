<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Marca;
use App\Models\Produto;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        //TODO::Adicionar os filtros de marca e categoria
        return DataTables::of($produtos)
            ->addColumn('action', 'produto.action')
            ->editColumn('created_at', function($produto){
                return $produto->created_at->format('d/m/Y');
            })
            ->editColumn('criado_por', function($produto){
                return User::findOrFail($produto->created_by)->value('username');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function form($id = 0)
    {
        $produto = $id > 0 ? Produto::findOrFail($id) : new Produto();
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::select('id', 'nome')->get()->toArray();

        return view('produto.form', compact('produto', 'marcas', 'categorias', 'fornecedores')); 
    }

    public function store(Request $request, $id = 0)
    {

        try{
            
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'categoria' => 'required',
                'marca' => 'required',
                'fornecedor' => 'required',
                'unidade_medida' => 'required',
                'vl_custo' => 'required|numeric',
                'vl_venda' => 'required|numeric',
                'descricao' => 'required',
                'info' => 'required'
            ],[
                'nome.required' => 'Insira o nome do produto!',
                'categoria.required' => 'A categoria é obrigatória!',
                'marca.required' => 'A marca é obrigatória!',
                'fornecedor.required' => 'O fornecedor é obrigatório!',
                'unidade_medida.required' => 'A unidade de medida é obrigatória!',
                'vl_custo.required' => 'O valor de compra é obrigatório!',
                'vl_custo.numeric' => 'O valor de compra deve ser um número!',
                'vl_venda.required' => 'O valor de venda é obrigatório!',
                'vl_venda.numeric' => 'O valor de venda deve ser um número!',
                'descricao.required' => 'A descricao é obrigatória!',
                'info.required' => 'A informação nutricional é obrigatória!',
            ]);

            if($validator->fails()){
                throw new \Exception(implode('; ', $validator->errors()->all()),-1);
            }

            DB::beginTransaction();
            
            $array_store = [
                'categoria_id' => $request->categoria, 
                'marca_id' => $request->marca, 
                'fornecedor_id' => $request->fornecedor, 
                'nome' => $request->nome, 
                'created_by' => Auth()->user()->id,
                'descricao' => $request->descricao, 
                'unidade_medida' => $request->unidade_medida, 
                'vl_custo' => $request->vl_custo, 
                'vl_venda' => $request->vl_venda, 
                'info_nutricional' => $request->info
            ];

            if($id != 0){
                //UPDATE
                unset($array_store['created_by']);
                $produto = Produto::findOrFail($id);
                $produto->update($array_store);
            }else{
                //CREATE
                $produto = Produto::create($array_store);
            }

            DB::commit();

            return redirect()->route('produto.index');

        }catch(\Exception $e){
            report($e);
            DB::rollback();
        }
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            
            $produto = Produto::findOrFail($id);
            
            $qtd = $produto->getQuantidadeProduto();
            if($qtd != 0){
                throw new \Exception('Não é possivel excluir o produto, pois ainda restam '. $qtd . ' unidades em estoque', -1);
            }

            $produto->delete();

            DB::commit();
            
            return redirect()->route('produto.index');

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
        }
    }

    public function detalhes($id)
    {
        $produto = Produto::findOrFail($id);
        $categoria = $produto->categoria->nome;
        $fornecedor = $produto->fornecedor->nome;

        return view('produto.detalhes', compact('produto', 'categoria', 'fornecedor'));
    }

}
