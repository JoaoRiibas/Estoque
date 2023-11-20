@extends('layouts.modal', [
    'title' => 'Produtos da categoria - ' . $categoria->nome
])

@section('footer')
    <button type="button" data-bs-dismiss="modal"
        class="btn btn-outline-primary"><i class="fa fa-times"></i> Fechar</button>
@endsection

@section('content')
    <div class="row col-md-12">
    
        @foreach($array as $key => $arr)
            <div class="table">
                <table class="table-responsive col-md-12">

                    <tr style="{{$array_total[$key] < 100 ? 'background-color:yellow' : ''}}">
                        <th colspan="2" class="text-semibold">{{$key}}</th>
                        <th class="text-semibold text-center">Total em estoque: {{$array_total[$key]}}</th>
                    <tr>

                    @foreach ($arr as $a)
                        <tr style="{{date_format(date_create($a['validade']), 'Y-m-d') < date('Y-m-d') ? 'background-color:red' : ''}}">
                            <td><strong>Lote: </strong>{{$a['lote']}}</td>
                            <td><strong>Quantidade: </strong>{{$a['entrada'] - $a['saida']}}</td>
                            <td class="text-center"><strong>Validade: </strong>{{ date_format(date_create($a['validade']), 'd/m/Y')}}</td>
                        <tr>
                    @endforeach 
                </table>
            </div>
            
        @endforeach
            
    </div>
@endsection