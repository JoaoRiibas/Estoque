<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class UserController extends Controller
{
    public function index(Builder $builder)
    {

        if(request()->ajax()){
            $users = User::query();
            
            return DataTables::of($users)
                ->editColumn('created_at', function($user){
                    return $user->created_at->format('d/m/Y');
                })
                ->addColumn('action', function($user){
                    return view('user.action', [
                        'user' => $user
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'username', 'name' => 'username', 'title' => 'Nome'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Criado Em'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Opções', 'searchable' => false, 'class' => 'td-actions']
        ]);

        return view('user.index', compact('html'));
    }

    public function form($id = 0)
    {
        $user = $id > 0 ? User::findOrFail($id) : new User();
    
        return view('user.form', compact('user'));
    }

    public function store(Request $request, $id = 0)
    {
        try{

            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'email' => 'required',
                'password' => 'required'
            ],[
                'nome.required' => 'O nome é obrigatório!',
                'email.required' => 'O email é obrigatória!',
                'password.required' => 'A senha é obrigatória!'
            ]);

            if($validator->fails()){
                throw new \Exception(implode('; ', $validator->errors()->all()),-1);
            }

            DB::beginTransaction();

                $array_store = [
                    'username' => $request->nome,
                    'email' => $request->email,
                    'password' => $request->password
                ];

            if($id != 0){
                //UPDATE
                $user = User::findOrFail($id);
                $user->update($array_store);
            }else{
                $user = User::create($array_store);
            }

            DB::commit();

            return redirect()->route('user.index')->with('success', 'Registro salvo com sucesso!');

        }catch(\Exception $e){
            report($e);
            DB::rollback();
            return redirect()->route('user.index')->with('error', $e->getCode() == -1 ? $e->getMessage() : 'Ocorreu um erro ao salvar o registro!');
        }
    }

    // public function delete($id)
    // {
    //     try{
    //         DB::beginTransaction();
            
    //         $user = User::findOrFail($id);
    //         $user->delete();

    //         DB::commit();
            
    //         return redirect()->route('user.index')->with('success', 'Registro excluido com sucesso!');

    //     }catch(\Exception $e){
    //         report($e);
    //         DB::rollBack();
    //         return redirect()->route('user.index')->with('error', $e->getCode() == -1 ? $e->getMessage() : 'Ocorreu um erro ao excluir o registro!');
    //     }
    // }
}
