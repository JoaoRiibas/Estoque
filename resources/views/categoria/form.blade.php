@extends('layouts.modal', [
    'title' => !$categoria->id ? 'Cadastro de categoria' : 'Editar categoria - ' . $categoria->nome,
    'formroute'=> route('categoria.store', [$categoria->id])
])

@section('footer')
    <button type="button" data-dismiss="modal"
            class="btn btn-link"><i class="fa fa-times"></i> Fechar</button>

    <button type="submit" class="btn btn-outline-primary pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
@endsection

@section('content')
<div class="row">
    <div class="col-12 form-group">
        <label>Nome</label>
        <input name="nome" type="text" value="{{$categoria->nome}}" class="form-control">
    </div>
    <div class="col-12 form-group">
        <label>Descrição</label>
        <input name="descricao" type="text-area" value="{{$categoria->descricao}}" class="form-control">
    </div>
@endsection