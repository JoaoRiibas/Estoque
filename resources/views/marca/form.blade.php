@extends('layouts.modal', [
    'title' => !$marca->id ? 'Cadastro de marca' : 'Editar marca - ' . $marca->nome,
    'formroute'=> route('marca.store', [$marca->id])
])

@section('footer')
    <button type="button" data-bs-dismiss="modal"
            class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>

    <button type="submit" class="btn btn-outline-primary pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
@endsection

@section('content')
<div class="row">
    <div class="col-12 form-group">
        <label>Nome</label>
        <input name="nome" type="text" value="{{$marca->nome}}" class="form-control">
    </div>
@endsection