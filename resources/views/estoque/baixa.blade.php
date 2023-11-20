@extends('layouts.modal', [
    'title' => 'Baixa de produtos',
    'formroute'=> route('estoque.store', 1)
]);

@section('footer')
    <button type="button" data-bs-dismiss="modal"
        class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>

    <button type="submit" class="btn btn-outline-primary pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 form-group">
            <label>Produto</label>
            <select name="produto" class="form-control">
                <option value="">Selecione</option>
                @foreach($produtos as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                @endforeach
            </select>
        </div>
   
        <div class="col-md-6 form-group">
            <label>Lote</label>
            <select name="lote" class="form-control">
                <option value="">Selecione</option>
                @foreach($lotes as $lote)
                    <option value="{{$lote->id}}">{{$lote->cod_lote . ' - ' . $lote->descricao}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            <label>Quantidade</label>
            <input name="quantidade" type="text" value="" class="form-control">
        </div>
    </div>

@endsection