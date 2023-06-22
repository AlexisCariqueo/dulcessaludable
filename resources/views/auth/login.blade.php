@extends('layouts.tienda-plantilla')

@section('title', 'Inicio Sessión')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->has('login') || $errors->has('password'))
                <div class="alert alert-danger">
                    <ul>
                        @if ($errors->has('login'))
                            <li>{{ $errors->first('login') }}</li>
                        @endif
                        @if ($errors->has('password'))
                            <li>{{ $errors->first('password') }}</li>
                        @endif
                    </ul>
                </div>
            @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <br>
            <div class="card">
                <div class="card-header">Inicio de Sesion</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="login" class="col-md-4 col-form-label text-md-right">Nombre de usuario o correo electrónico</label>
                        
                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>
                        
                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>       
                        <br>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recuerdame
                                    </label>
                                </div>
                            </div>
                            @if (Route::has('register'))
                                <p class="text-center">No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn mi-boton-personalizado">
                                    Login
                                </button>                                
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: rgb(253, 149, 63);">
                                    Olvidaste tu contraseña?
                                </a>                                
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .mi-boton-personalizado {
        background-color: #f54242; 
        color: white; 
    }
    
    .mi-boton-personalizado:hover {
        background-color: #ff6666; 
    }
    </style>
@endsection


