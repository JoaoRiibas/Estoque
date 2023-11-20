@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

    <div class="container-fluid py-4">
 
        <div class="row">
            @for($i = 0; $i < sizeof($categorias); $i++)
            
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <img src="/img/categorias/{{$categorias[$i]['foto_path']}}">
                        <div class="card-body p-3">
                            <div class="row">
                                <a onclick="openModal('{{route('dashboard.listagem', $categorias[$i]['id'])}}')">
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