@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header min-vh-100">
            <div class="container container mt--8 pb-5">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>Cadastre-se com o Email</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register.perform') }}">
                                    @csrf
                                    <div class="flex flex-col mb-3">
                                        <input type="text" name="username" class="form-control" placeholder="Usuário" aria-label="Name" value="{{ old('username') }}" >
                                        @error('username') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" value="{{ old('email') }}" >
                                        @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Senha" aria-label="Password">
                                        @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Cadastrar</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Ja possui uma conta? <a href="{{ route('login') }}"
                                            class="text-dark font-weight-bolder">Entrar</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
