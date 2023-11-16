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
            ['data' => 'action', 'name' => 'action', 'title' => 'Ações', 'class'=> 'td-actions'],
        ]);

        return view('fornecedor.index', compact('html'));
    }

    public function form($id = 0)
    {
        $fornecedor = $id > 0 ? Fornecedor::findOrFail($id) : new Fornecedor;
        $telefones = $fornecedor->telefones;

        return view('fornecedor.form', compact('fornecedor', 'telefones'));
    }

    public function store(Request $request, $id = 0)
    {
        try{
            
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'cnpj' => 'required|digits:14',
                'cep' => 'required|digits:8',
                'estado' => 'required',
                'cidade' => 'required',
                'logradouro' => 'required',
            ],[
                'nome.required' => 'Insira o nome do fornecedor!',
                'cnpj.required' => 'Insira o cnpj!',
                'cnpj.digits' => 'O cnpj deve possuir 14 digitos!',
                'cep.required' => 'Insira o cep!',
                'cep.digits' => 'O cep deve possuir 8 digitos!',
                'estado.required' => 'Insira o estado!',
                'cidade.required' => 'Insira o cidade!',
                'logradouro.required' => 'Insira o logradouro!',
                'telefone.required' => 'O fornecedor deve ter no mínimo um telefone!',
            ]);

            if($validator->fails()){
                throw new \Exception(implode('; ', $validator->errors()->all()),-1);
            }
            
            DB::beginTransaction();

            $array_store = [
                'nome' => $request->nome,
                'cnpj' => $request->cnpj,
            ];

            $array_endereco = [
                'cep' => $request->cep, 
                'estado' => $request->estado, 
                'cidade' => $request->cidade, 
                'logradouro' => $request->logradouro
            ];

            if($id != 0){
                //UPDATE
                $fornecedor = Fornecedor::findOrFail($id);
                $fornecedor->update($array_store);
                $fornecedor->endereco()->update($array_endereco);

            }else{
                //CREATE
                $fornecedor = Fornecedor::create($array_store);
                $fornecedor->endereco()->create($array_endereco);
            }

            $telefones = $fornecedor->telefones()->pluck('id');

            //Deleta o telefone que não está na request
            foreach($telefones as $telefone){
                $aux = 0;
                
                foreach($request->telefone_id as $req_tel){
                    if($telefone == $req_tel){
                        $aux++;
                    } 
                }

                if($aux == 0){
                    $fornecedor->telefones()->findOrfail($telefone)->delete();
                }
            }

            foreach($request->telefone_id as $key => $tel_id){
                
                $array_telefone = [
                    'numero' => $request->telefone[$key],
                    'is_whatsapp' => $request->whatsapp[$key] == 'Sim' ? 1 : 0
                ];

                if($tel_id == 0){
                    $telefone = $fornecedor->telefones()->create($array_telefone);
                }else{
                    $telefone = $fornecedor->telefones()->findOrFail($tel_id);
                    $telefone->update($array_telefone);
                }
            }

            DB::commit();

            return redirect()->route('fornecedor.index')->with('success', 'Registro salvo com sucesso!');

        }catch(\Exception $e){
            report($e);
            DB::rollback();
            return redirect()->route('fornecedor.index')->with('error', $e->getCode() == -1 ? $e->getMessage() : 'Ocorreu um erro ao salvar o registro!');
        }
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            
            $fornecedor = Fornecedor::FindOrFail($id);
            $fornecedor->delete();
            
            DB::commit();

            return redirect()->route('fornecedor.index')->with('success', 'Registro excluido com sucesso!');

        }catch(\Exception $e){
            report($e);
            DB::rollback();
            return redirect()->route('fornecedor.index')->with('error', $e->getCode() == -1 ? $e->getMessage() : 'Ocorreu um erro ao excluir o registro!');
        }
    }

    public function detalhes($id)
    {
        $fornecedor = Fornecedor::with('endereco')->findOrFail($id);
        $telefones = $fornecedor->telefones;

        return view('fornecedor.detalhes', compact('fornecedor', 'telefones'));

    }
}
