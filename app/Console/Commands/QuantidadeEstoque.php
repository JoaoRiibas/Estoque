<?php

namespace App\Console\Commands;

use App\Models\Produto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuantidadeEstoque extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:estoque';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para realizar a contagem de todos os produtos disponíveis no estoque';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $produtos = Produto::all();

        foreach($produtos as $produto){
            $entrada = DB::connection()->table('estoques')
            ->where('produto_id', $produto->id)
            ->where('operacao', 0)
            ->sum('qtd_produto');

            $saida = DB::connection()->table('estoques')
            ->where('produto_id', $produto->id)
            ->where('operacao', 1)
            ->sum('qtd_produto');

            $estoque[$produto->nome] = $entrada - $saida;

        }

        Log::info('Quantidade de produtos em estoque:');
        foreach($estoque as $key => $e){
            Log::info($key . ' = '  . $e);
        }
        Log::info('----------------------------------');
    }
}
