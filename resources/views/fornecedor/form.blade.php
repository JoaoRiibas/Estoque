@extends('layouts.modal', [
    'title' => !$fornecedor->id ? 'Cadastro de fornecedor' : 'Editar fornecedor - ' . $fornecedor->nome,
    'formroute'=> route('fornecedor.store', [$fornecedor->id])
])

@section('footer')
    <button type="button" data-bs-dismiss="modal"
        class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>


    <button type="submit" class="btn btn-outline-primary pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
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
            <input name="cep" type="text" value="{{isset($fornecedor->endereco) ? $fornecedor->endereco->cep : ''}}" class="form-control">
        </div>
        <div class="col-6 form-group">
            <label>Estado</label>
            <input name="estado" type="text" value="{{isset($fornecedor->endereco) ? $fornecedor->endereco->estado : ''}}" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-6 form-group">
            <label>Cidade</label>
            <input name="cidade" type="text" value="{{isset($fornecedor->endereco) ? $fornecedor->endereco->cidade : ''}}" class="form-control">
        </div>
        <div class="col-6 form-group">
            <label>Logradouro</label>
            <input name="logradouro" type="text" value="{{isset($fornecedor->endereco) ? $fornecedor->endereco->logradouro: ''}}" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-12 form-group">
            <label>Telefone(s)</label>
            {{-- <input name="telefone" type="number" value="{{$fornecedor->telefone}}" class="form-control"> --}}
        </div>
    </div>

@endsection