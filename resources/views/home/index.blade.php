@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Categorias de Produtos'])
    <div class="container-fluid py-4">
 
        <div class="row">
            @for($i = 0; $i < sizeof($categorias); $i++)
            
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <a href={{route('dashboard.listagem', $categorias[$i]['id'])}} class="font-weight-bold">
                                    {{$categorias[$i]['nome']}}
                                    <h6 class="text-semibold"><small>{{$categorias[$i]['descricao']}}</small></h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if($i % 3 == 0)
                    <br><br><br><br><br>
                @endif
                
            @endfor
        </div>

    </div>
@endsection