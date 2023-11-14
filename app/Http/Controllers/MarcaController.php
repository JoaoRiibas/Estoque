<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class MarcaController extends Controller
{
    public function index(Builder $builder)
    {

        if(request()->ajax()){
            $marcas = Marca::query();
            
            return DataTables::of($marcas)
                ->addColumn('action', function($marca){
                    return view('marca.action', [
                        'marca' => $marca
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome', 'class'=> 'text-semibold'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Ações', 'class'=> 'td-actions'],
        ]);

        return view('marca.index', compact('html'));
    }

    public function form($id = 0)
    {
        $marca = $id > 0 ? Marca::findOrFail($id) : new Marca();

        return view('marca.form', compact('marca'));
    }

    public function store(Request $request, $id = 0)
    {
        try{
            $aux_validate = $id == 0 ? 'required|unique:marcas' : 'required';
            
            $validator = Validator::make($request->all(), [
                'nome' => $aux_validate,
            ],[
                'nome.required' => 'Insira o nome da marca!',
                'nome.unique' => 'Marca ja existente!',
            ]);

            if($validator->fails()){
                throw new \Exception(implode('; ', $validator->errors()->all()),-1);
            }

            DB::beginTransaction();

            $array_store = [
                'nome' => $request->nome,
            ];

            if($id != 0) {
                //UPDATE
                $marca = Marca::findOrFail($id);
                $marca->update($array_store);
            }else {
                //INSERT
                $marca = Marca::create($array_store);
            }

            DB::commit();
            
            return redirect()->route('marca.index')->with('success', 'Registro salvo com sucesso!');
            
        }catch(\Exception $e){
            report($e);
            DB::rollBack();
            return redirect()->route('marca.index')->with('error', $e->getCode() == -1 ? $e->getMessage() : 'Ocorreu um erro ao salvar o registro!');
        }
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            
            $marca = Marca::findOrFail($id);

            if($marca->getVinculoProduto() > 0){
                throw new \Exception('Não é possivel excluir a marca, pois existem produtos vinculados a ela', -1);
            }

            $marca->delete();

            DB::commit();

            return redirect()->route('marca.index')->with('success', 'Registro excluido com sucesso!');

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
            return redirect()->route('marca.index')->with('error', $e->getCode() == -1 ? $e->getMessage() : 'Ocorreu um erro ao excluir o registro!');
        }
    }

}
