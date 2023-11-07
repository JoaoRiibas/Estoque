@extends('layouts.modal', [
    'title' => !$lote->id ? 'Cadastro de lote' : 'Editar lote - ' . $lote->cod_lote,
    'formroute'=> route('lote.store', [$lote->id])
])

@section('footer')
    <button type="button" data-dismiss="modal"
            class="btn btn-link"><i class="fa fa-times"></i> Fechar</button>

    <button type="submit" class="btn btn-success pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 form-group">
            <label>Número do Lote</label>
            <input name="codigo" type="number" value="{{$lote->cod_lote}}" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Descrição</label>
            <input name="descricao" type="text-area" value="{{$lote->descricao}}" class="form-control">
        </div>
    </div>
@endsection