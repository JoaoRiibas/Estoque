<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class CategoriaController extends Controller
{
    public function index(Builder $builder)
    {

        if(request()->ajax()){
            $categorias = Categoria::query();
            
            return DataTables::of($categorias)
                ->addColumn('action', function($categoria){
                    return view('categoria.action', [
                        'categoria' => $categoria
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome', 'class'=> 'text-semibold'],
            ['data' => 'descricao', 'name' => 'descricao', 'title' => 'Descrição', 'class'=> 'text-semibold'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Ações', 'class'=> 'td-actions'],
        ]);

        return view('categoria.index', compact('html'));
    }

    public function form($id = 0)
    {
        $categoria = $id > 0 ? Categoria::findOrFail($id) : new Categoria();

        return view('categoria.form', compact('categoria'));
    }

    public function store(Request $request, $id = 0)
    {
        try{
            $aux_validate = $id == 0 ? 'required|unique:categorias' : 'required';

            $validator = Validator::make($request->all(), [
                'nome' => $aux_validate,
                'descricao' => 'required',
            ],[
                'nome.required' => 'Insira o nome da categoria!',
                'nome.unique' => 'Categoria já existente!',
                'descricao.required' => 'Adescrição é obrigatória!',
            ]);

            if($validator->fails()){
                throw new \Exception(implode('; ', $validator->errors()->all()),-1);
            }

            DB::beginTransaction();

            $array_store = [
                'nome' => $request->nome,
                'descricao' => $request->descricao, 
                'foto_path' => 'Teste' 
                //TODO::Gravar path da foto
            ];

            if($id != 0) {
                //UPDATE
                $categoria = Categoria::findOrFail($id);
                $categoria->update($array_store);
            }else {
                //INSERT
                $categoria = Categoria::create($array_store);
            }

            DB::commit();
            
            return redirect()->route('categoria.index');

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();

            DB::commit();

            return redirect()->route('categoria.index');

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
        }
    }

}
