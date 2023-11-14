@extends('layouts.modal', [
    'title' => 'Informações - ' . $produto->nome,
])

@section('footer')
    <button type="button" data-bs-dismiss="modal"
        class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <ul>
                <li><strong>Unidade de medida: </strong>{{$produto->unidade_medida}}</li>
                <li><strong>Valor de Custo: </strong>{{number_format($produto->vl_custo, 2)}} R$</li>
                <li><strong>Fornecedor: </strong>{{$fornecedor}}</li>
                <li><strong>Descrição do produto: </strong>{{$produto->descricao}}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul>
                <li><strong>Categoria: </strong>{{$categoria}}</li>
                <li><strong>Valor de Venda: </strong>{{number_format($produto->vl_venda, 2)}} R$</li>
                <li><strong>Informação Nuticional: </strong>{{$produto->info_nutricional}}</li>
            </ul>
        </div>
    </div>

@endsection