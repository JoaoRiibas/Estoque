@extends('layouts.modal', [
    'title' => !$produto->id ? 'Cadastro de produto' : 'Editar produto - ' . $produto->nome,
    'formroute'=> route('produto.store', [$produto->id])
])

@section('footer')
    <button type="button" data-bs-dismiss="modal"
        class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>


    <button type="submit" class="btn btn-outline-primary pull-right">Salvar <i class="fa fa-arrow-right"></i></button>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Nome</label>
            <input name="nome" type="text" value="{{$produto->nome}}" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 form-group">
            <label>Categoria</label>
            <select name="categoria" class="form-control">
                <option value="">Selecione</option>
                @foreach($categorias as $categoria)
                    <option {{$categoria->id == $produto->categoria_id ? 'selected' : ''}} value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-4 form-group">
            <label>Marca</label>
            <select name="marca" class="form-control">
                <option value="">Selecione</option>
                @foreach($marcas as $marca)
                    <option {{$marca->id == $produto->marca_id ? 'selected' : ''}} value="{{$marca->id}}">{{$marca->nome}}</option>
                @endforeach
            </select>
        </div>
    
        <div class="col-md-4 form-group">
            <label>Fornecedor</label>
            <select name="fornecedor" class="form-control">
                <option value="">Selecione</option>
                @foreach($fornecedores as $fornecedor)
                    <option {{$fornecedor['id'] == $produto->fornecedor_id ? 'selected' : ''}} value="{{$fornecedor['id']}}">{{$fornecedor['nome']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 form-group">
            <label>Unidade de Medida</label>
            <input name="unidade_medida" type="text" value="{{$produto->unidade_medida}}" class="form-control">
        </div>
        <div class="col-md-4 form-group">
            <label>Valor de Compra</label>
            <input name="vl_custo" type="number" step="0.01" value="{{$produto->vl_custo}}" class="form-control">
        </div>
        <div class="col-md-4 form-group">
            <label>Valor de Venda</label>
            <input name="vl_venda" type="number" step="0.01" value="{{$produto->vl_venda}}" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 form-group">
            <label>Descrição</label>
            <input name="descricao" type="text" value="{{$produto->descricao}}" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 form-group">
            <label>Informações Nutricionais</label>
            <input name="info" type="text" value="{{$produto->info_nutricional}}" class="form-control">
        </div>
    </div>

@endsection