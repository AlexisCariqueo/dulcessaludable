@extends('layouts.tienda-plantilla')

@section('title', 'Crear Usuario')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <br>
        <div class="col-md-8 offset-md-2">
            <br>
            <div class="card">
                <div class="card-header">{{ __('Regístrate') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repetir Contraseña:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>
                        @if (Route::has('login'))
                        <p class="text-center">Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
                        @endif
                        <br>
                        <button type="submit" class="btn mi-boton-personalizado">
                            Regístrate
                        </button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .mi-boton-personalizado {
        background-color: #f54242; /* Aquí pones el color de fondo que quieras */
        color: white; /* Aquí pones el color de texto que quieras */
    }
    
    .mi-boton-personalizado:hover {
        background-color: #ff6666; /* Aquí pones el color de fondo que quieras cuando el mouse esté sobre el botón */
    }
    </style>
@endsection
