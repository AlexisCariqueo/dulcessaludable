@extends('layouts.tienda-plantilla')

@section('content')
<div class="container">
    <h1 class="mb-4">Recuperar contraseña</h1>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingrese un correo electrónico válido.
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary mi-boton-personalizado">Enviar enlace de restablecimiento de contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .mi-boton-personalizado {
        background-color: #ff6666; /* Cambia este color a tu gusto */
        border-color: #ff6666; /* Cambia este color a tu gusto */
    }

</style>
@endsection