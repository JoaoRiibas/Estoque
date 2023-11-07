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
            ['data' => 'action', 'name' => 'action', 'title' => 'Ações', 'class'=> 'col-md-2'],
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
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
            ],[
                'nome.required' => 'Insira o nome da marca!',
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
            
            return response()->json(['success'=> true, 'message' => '', 'data' => []]);

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
        }
    }


    public function delete($id)
    {
        try{
            DB::beginTransaction();
            
            $marca = Marca::findOrFail($id);
            $marca->delete();

            DB::commit();

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
        }
    }

}
