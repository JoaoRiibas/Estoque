@extends('layouts.modal', [
    'title' => !$lote->id ? 'Cadastro de lote' : 'Editar lote - ' . $lote->cod_lote,
    'formroute'=> route('lote.store', [$lote->id])
])

@section('footer')
    <button type="button" data-bs-dismiss="modal"
        class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>


    <button type="submit" class="btn btn-outline-primary pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
@endsection

@section('content')
    <div class="row">
        <div class="col-6 form-group">
            <label>Número do Lote</label>
            <input name="codigo" type="number" value="{{$lote->cod_lote}}" class="form-control">
        </div>
        <div class="col-6 form-group">
            <label>Data de Validade</label>
            <input name="dt_validade" type="date" value="{{!$lote->validade ? date('Y-m-d') : $lote->validade->format('Y-m-d')}}" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Descrição</label>
            <input name="descricao" type="text-area" value="{{$lote->descricao}}" class="form-control">
        </div>
    </div>

@endsection