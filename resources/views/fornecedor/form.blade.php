@extends('layouts.modal', [
    'title' => !$fornecedor->id ? 'Cadastro de fornecedor' : 'Editar fornecedor - ' . $fornecedor->nome,
    'formroute'=> route('fornecedor.store', [$fornecedor->id])
])

@section('footer')
    <button type="button" data-dismiss="modal"
            class="btn btn-link"><i class="fa fa-times"></i> Fechar</button>

    <button type="submit" class="btn btn-success pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
@endsection

@section('content')
    <div class="row">
        <div class="col-6 form-group">
            <label>Nome</label>
            <input name="nome" type="text" value="{{$fornecedor->nome}}" class="form-control">
        </div>
        <div class="col-6 form-group">
            <label>CNPJ</label>
            <input name="cnpj" type="number" value="{{$fornecedor->cnpj}}" class="form-control">
        </div>
    </div>
    
    <div class="row">
        <div class="col-6 form-group">
            <label>CEP</label>
            <input name="cep" type="text" value="" class="form-control">
        </div>
        <div class="col-6 form-group">
            <label>Estado</label>
            <input name="estado" type="text" value="" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-6 form-group">
            <label>Cidade</label>
            <input name="cidade" type="text" value="" class="form-control">
        </div>
        <div class="col-6 form-group">
            <label>Endereço</label>
            <input name="endereco" type="text" value="" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-12 form-group">
            <label>Telefone</label>
            <input name="telefone" type="number" value="" class="form-control">
        </div>
    </div>

@endsection