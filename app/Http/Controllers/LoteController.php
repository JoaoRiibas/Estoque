<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class LoteController extends Controller
{
    public function index(Builder $builder)
    {
    
        if(request()->ajax()){
            $lotes = Lote::query();
            
            return DataTables::of($lotes)
                ->addColumn('action', function($lote){
                    return view('lote.action', [
                        'lote' => $lote
                    ]);
                })
                ->editColumn('validade', function($lote){
                    return $lote->validade->format('d/m/Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'cod_lote', 'name' => 'cod_lote', 'title' => 'Número do lote', 'class'=> 'text-semibold'],
            ['data' => 'descricao', 'name' => 'descricao', 'title' => 'Descrição', 'class'=> 'text-semibold'],
            ['data' => 'validade', 'name' => 'validade', 'title' => 'Valido Até', 'class'=> 'text-semibold'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Ações', 'class'=> 'td-actions'],
        ]);

        return view('lote.index', compact('html'));
    }

    public function form($id = 0)
    {
        $lote = $id > 0 ? Lote::findOrFail($id) : new Lote();
    
        return view('lote.form', compact('lote'));
    }

    public function store(Request $request, $id = 0)
    {
        try{

            $validator = Validator::make($request->all(), [
                'codigo' => 'required|numeric',
                'descricao' => 'required',
                'dt_validade' => 'required|date',
            ],[
                'codigo.required' => 'Insira o código do lote!',
                'codigo.numeric' => 'O codigo do lote deve ser um número!',
                'descricao.required' => 'A descrição é obrigatória!',
                'dt_validade.date' => 'A data de validade deve ser uma data!',
            ]);

            if($validator->fails()){
                throw new \Exception(implode('; ', $validator->errors()->all()),-1);
            }
            
            DB::beginTransaction();

            $array_store = [
                'cod_lote' => $request->codigo,
                'descricao' => $request->descricao,
                'validade' => DateTime::createFromFormat('Y-m-d',$request->dt_validade)
            ];

            if($id != 0) {
                //UPDATE
                $lote = Lote::findOrFail($id);
                $lote->update($array_store);
            }else {
                //INSERT
                $lote = Lote::create($array_store);
            }

            DB::commit();
        
            // return response()->json(['success'=> true, 'message' => '', 'data' => []]);
            return redirect()->route('lote.index');

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            
            $lote = Lote::findOrFail($id);
            $lote->delete();

            DB::commit();
            
            return redirect()->route('lote.index');

        }catch(\Exception $e){
            report($e);
            DB::rollBack();
        }
    }

}
