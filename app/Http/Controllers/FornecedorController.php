<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        try{
            
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'cnpj' => 'required',
                'cep' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'endereco' => 'required',
                'telefone' => 'required'
            ],[
                'nome.required' => 'Insira o nome do fornecedor!',
                'cnpj.required' => 'Insira o cnpj!',
                'cep.required' => 'Insira o cep!',
                'estado.required' => 'Insira o estado!',
                'cidade.required' => 'Insira o cidade!',
                'endereco.required' => 'Insira o endereco!',
                'telefone.required' => 'Insira o telefone!'
            ]);

            DB::beginTransaction();

            $array_store = [
                'nome' => $request->nome,
                'cnpj' => $request->cnpj,
                'telefone' => $request->telefone
            ];

            $array_endereco = [
                'cep' => $request->cep, 
                'estado' => $request->estado, 
                'cidade' => $request->cidade, 
                'endereco' => $request->endereco
            ];

            if($id != 0){
                //UPDATE

                $fornecedor = Fornecedor::findOrFail($id);
                $fornecedor->update($array_store);
                $fornecedor->endereco()->update($array_endereco);
                
                //TODO::Fazer update do telefone

            }else{
                //CREATE

                $fornecedor = Fornecedor::create($array_store);
                $fornecedor->endereco()->create($array_endereco);
                
                //TODO::Fazer create do telefone
            }

            DB::commit();

            // return response()->json(['success'=> true, 'message' => '', 'data' => []]);

        }catch(\Exception $e){
            report($e);
            DB::rollback();

            // return response()->json(['success'=> false, 'message' => '', 'data' => []]);
        }
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            
            $fornecedor = Fornecedor::FindOrFail($id);
            $fornecedor->delete();
            
            DB::commit();

            // return response()->json(['success'=> true, 'message' => '', 'data' => []]);

        }catch(\Exception $e){
            report($e);
            DB::rollback();
        }
    }
}
