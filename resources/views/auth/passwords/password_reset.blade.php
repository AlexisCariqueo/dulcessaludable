@extends('layouts.tienda-plantilla')

@section('content')
    <div class="container">
        <h1 class="mb-4">Restablecer contraseña</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('password.reset.update') }}" class="needs-validation" novalidate>
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor ingrese un correo electrónico válido.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Nueva contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor ingrese una contraseña.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar nueva contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor confirme su contraseña.
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary mi-boton-personalizado">Restablecer contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .mi-boton-personalizado {
            background-color: #f54b4b; 
            border-color: #f55353; 
            color: #ffffff; 
        }
    
        .mi-boton-personalizado:hover {
            background-color: #ff3333; 
            border-color: #ff3333; 
        }
    </style>
    
@endsection

