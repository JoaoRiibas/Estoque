@extends('layouts.modal', [
    'title' => 'Informações - ' . $fornecedor->nome,
])

@section('footer')
    <button type="button" data-bs-dismiss="modal"
        class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h6 class="text-semibold">Endereço:</h6>
            <ul>
                <li>{{$fornecedor->endereco->logradouro . ', ' .
                    $fornecedor->endereco->cidade . ' - ' . $fornecedor->endereco->estado }}</li> 
                <li>CEP: {{$fornecedor->endereco->cep}}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h6 class="text-semibold">Telefone(s):</h6>
            <div class="table">
                <table class="col-md-12 table-responsive">
                    <tr>
                        <th class="text-semibold">Telefone</th>
                        <th class="text-center text-semibold">Whatsapp</th>
                    </tr>
                    
                    @foreach($telefones as $telefone)
                        <tr>
                            <td>{{$telefone->numero}}</td>
                            <td class="text-center">{{$telefone->is_whatsapp == 1 ? 'Sim' : 'Não'}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection