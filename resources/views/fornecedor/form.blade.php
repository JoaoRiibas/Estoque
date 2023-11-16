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

    <hr>

    <div class="row">
        
        <div class="col-md-8 form-group">
            <label>Telefone</label>
            <input name="telefone" id="telefone" type="number" value="" class="form-control">
            <button type="button" onclick = "addTelefone()" class="btn text-primary"><i class="fa fa-plus"></i></button>
        </div>
        <div class="col-md-4 form-group">
            <label>Whatsapp</label>
            <select class="form-control" id="whatsapp">
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>
        </div>
        
    </div>
    
    <hr>

    <div class="row">  
        <div class="table">  
            <table id="table_telefones" class="col-md-12 table-responsive">
                <tr id="tr_header">
                    <th class="text-semibold">Telefone</th>
                    <th class="text-center text-semibold">Whatsapp</th>
                    <th class="text-center text-semibold">Ações</th>
                </tr>
                
                @foreach($telefones as $telefone)
                    <tr id="tr_{{$telefone->id}}">    
                        <td>{{$telefone->numero}}</td>
                        <td class="text-center">{{$telefone->is_whatsapp == 1 ? 'Sim' : 'Não'}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-link text-danger" onclick="remove_tr('{{$telefone->id}}')">
                                <i class="fa fa fa-trash"></i></button>
                            <input type="hidden" id="telefone_id_{{$telefone->id}}" name="telefone_id[{{$telefone->id}}]" value="{{$telefone->id}}">
                            <input type="hidden" id="telefone_{{$telefone->id}}" name="telefone[{{$telefone->id}}]" value="{{$telefone->numero}}">
                            <input type="hidden" id="whatsapp_{{$telefone->id}}" name="whatsapp[{{$telefone->id}}]" value="{{$telefone->is_whatsapp == 1 ? 'Sim' : 'Não'}}">
                        </td>
                    </tr>
                @endforeach
            
            </table>
        </div>
    </div>

    <script>
        
        function addTelefone(){
            
            var telefone = $('#telefone').val();
            var whatsapp = $('#whatsapp').val();
            var random = (Math.random() * 10).toString().replace('.','');

            var html = '<tr id="tr_'+random+'">' +
                '<td>'+telefone+'</td>' +
                '<td class="text-center">'+whatsapp+'</td>' +
                '<td class="text-center">' +
                '<button type="button" class="btn btn-link text-danger" onclick="remove_tr(' + random + ')"><i class="fa fa fa-trash"></i></button>' +
                '<input type="hidden" id="telefone_id_' + random +  '" name="telefone_id[' + random + ']" value="0">' +
                '<input type="hidden" id="telefone_' + random +  '" name="telefone[' + random + ']" value="'+telefone+'">' +
                '<input type="hidden" id="whatsapp_' + random +  '" name="whatsapp[' + random + ']" value="'+whatsapp+'">' +
                '</td>' +
                '</tr>';
            
            $('#table_telefones').append(html);
            
            $('#telefone').val('');
            $('#whatsapp').val('Sim');
        }

        function remove_tr(id) {
            console.log(id);
            $('#tr_' + id).remove();
        }


    </script>

@endsection
