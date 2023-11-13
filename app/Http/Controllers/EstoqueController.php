<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Lote;
use App\Models\Produto;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class EstoqueController extends Controller
{
    public function index(Builder $builder)
    {
        $html = $builder
            ->parameters([
                'order' => [[0, 'desc']],
                'autoWidth' => false
            ])->columns([
                ['data' => 'produto.nome', 'name' => 'produto.nome', 'title' => 'Produto'],
                ['data' => 'lote.cod_lote', 'name' => 'lote.cod_lote', 'title' => 'Lote'],
                ['data' => 'local_armazenamento', 'name' => 'local_armazenamento', 'title' => 'Armazenado Em'],
                ['data' => 'created_by', 'name' => 'created_by', 'title' => 'Responsável'],
                ['data' => 'qtd_produto', 'name' => 'qtd_produto', 'title' => 'Quantidade'],
                ['data' => 'operacao', 'name' => 'operacao', 'title' => 'Operação'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Data Entrada'],
                ['data' => 'validade_produto', 'name' => 'validade_produto', 'title' => 'Válido Até'],
            ])->ajax([
                'url' => route('estoque.filter'),
                'type' => 'POST',
                'data' => 'function(d){
                        d._token = "' . csrf_token() . '"
                }',
            ]);

        return view('estoque.index', compact('html'));
    }

    public function filter(Request $request)
    {
        $estoques = Estoque::query()->with(['produto', 'lote']);
        //TODO::Adicionar os filtros 
        return DataTables::of($estoques)
            ->editColumn('created_by', function($produto){
                return User::findOrFail($produto->created_by)->value('username');
            })
            ->editColumn('created_at', function($estoque){
                return $estoque->created_at->format('d/m/Y');
            })
            ->editColumn('validade_produto', function($estoque){
                return $estoque->validade_produto->format('d/m/Y');
            })
            ->editColumn('operacao', function($estoque){
                // return '<span class="badge bg-gradient-' . $estoque->getOperacaoCor() . '">' . $estoque->getOperacaoNome() . '</span>';
                return $estoque->getOperacaoNome();
            })
            ->make(true);
    }

    public function entrada()
    {
        $produtos = Produto::all();
        $lotes = Lote::all();

        return view('estoque.entrada', compact('produtos', 'lotes'));
    }

    public function baixa()
    {
        $produtos = Produto::all();
        $lotes = Lote::all();

        return view('estoque.baixa', compact('produtos', 'lotes'));
    }

    public function store(Request $request, $operacao)
    {
    
        try{
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'produto' => 'required',
                'lote' => 'required',
                'quantidade' => 'required',
                'local_armazenamento' => $operacao == 0 ? 'required' : ''
            ]);

            if($validator->fails()){
                throw new \Exception(implode('; ', $validator->errors()->all()),-1);
            }

            if($operacao == 0){
                //ENTRADA
                
                $array_store = [
                    'produto_id' => $request->produto, 
                    'lote_id' => $request->lote,  
                    'operacao' => $operacao,
                    'local_armazenamento' => $request->local_armazenamento, 
                    'qtd_produto' => $request->quantidade, 
                    'created_by' => Auth()->user()->id
                ];

                $estoque = Estoque::create($array_store);
            }
            else{
                //BAIXA

                $qtd_estoque = $this->getQuantidadeProduto($request->produto);
                
                if($qtd_estoque - $request->quantidade < 0){
                    throw new \Exception('A quantidade de baixa é superior a quantidade em estoque',-1);
                }
                
                $produto = Estoque::query()
                    ->where('produto_id', $request->produto)
                    ->where('lote_id', $request->lote)
                    ->first()
                    ->get()
                    ->toArray();
                
                $array_store = [
                    'produto_id' => $request->produto, 
                    'lote_id' => $request->lote,  
                    'operacao' => $operacao,
                    'local_armazenamento' => $produto[0]['local_armazenamento'], 
                    'qtd_produto' => $request->quantidade, 
                    'created_by' => Auth()->user()->id
                ];

                $estoque = Estoque::create($array_store);         
            }

            DB::commit();

            return redirect()->route('estoque.index');

        }catch(\Exception $e){
            report($e);
            DB::rollback();
        }
    }

    public function getQuantidadeProduto($produto)
    {
        $entrada = DB::connection()->table('estoques')
            ->where('produto_id', $produto)
            ->where('operacao', 0)
            ->sum('qtd_produto');

        $saida = DB::connection()->table('estoques')
            ->where('produto_id', $produto)
            ->where('operacao', 1)
            ->sum('qtd_produto');

        $quantidade = $entrada - $saida;
        
        return $quantidade;
    }

}
