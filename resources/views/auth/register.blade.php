@extends('layouts.app')

@section('content')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container mt--8 pb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Nova conta</h4>
                                    <p class="mb-0">Utilize seu email para criar uma nova conta</p>
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
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Cadastrar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">Ja possui uma conta? 
                                        <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Entrar</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
