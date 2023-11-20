@extends('layouts.modal', [
    'title' => !$user->id ? 'Cadastro de usuário' : 'Editar usuário - ' . $user->username,
    'formroute'=> route('user.store', [$user->id])
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
            <input name="nome" type="text" value="{{$user->username}}" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            <label>E-mail</label>
            <input name="email" type="text" value="{{$user->email}}" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <label>Senha</label>
            <input name="password" type="password" value="" class="form-control">
        </div>
    </div>

@endsection