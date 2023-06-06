@extends('layouts.tienda-plantilla')

@section('content')
        <div class="container">
@if(!empty($unpaidMessage))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $unpaidMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(!empty($shippingMessage))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ $shippingMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(!empty($incompleteMessage))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $incompleteMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Datos Personales -->
            <div class="card mb-4">
                <div class="card-header">Datos Personales</div>

                <div class="card-body">
                    <h5>Nombre: {{ Auth::user()->name }}</h5>
                    <h5>Email: {{ Auth::user()->email }}</h5>
                    <!-- Agrega aquí cualquier otro campo que quieras mostrar -->

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3 btn-editar">Editar Perfil</a>
                    <a href="{{ route('password.change') }}" class="btn btn-primary mt-3 btn-cambiar">Cambiar Contraseña</a>
                </div>
            </div>

<!-- Dirección -->
<div class="card mb-4">
    <div class="card-header">Dirección</div>

    <div class="card-body">
        @if($direccion)
            <div class="row">
                <div class="col-md-6">
                    <p>Calle: {{ $direccion->calle }}</p>
                    <p>Comuna: {{ $direccion->comuna }}</p>
                    <p>Numeración: {{ $direccion->piso }}</p>
                </div>
                <div class="col-md-6">
                    <p>Ciudad: Santiago</p>
                    <p>Código Postal: {{ $direccion->codigo_postal }}</p>
                    <p>Teléfono: {{ $direccion->numero }}</p>
                </div>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                No has proporcionado una dirección. Haz clic en el botón de abajo para agregar una.
            </div>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3 btn-agregar">Agregar Dirección</a>
        @endif
    </div>
</div>


            <!-- Mis Órdenes -->
            <div class="card">
                <div class="card-header">Mis Órdenes</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Número de Orden</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $orden)
                                <tr>
                                    <td>{{ $orden->id }}</td>
                                    <td>{{ $orden->estado ?? 'No Pagado' }}</td>
                                    <td>
                                        @if($orden->estado == null)
                                            <a href="{{ url('checkout-transferencia/' . $orden->id) }}" class="link-primary">Finalizar Compra</a>
                                        @else
                                            <!-- Puedes agregar otras acciones aquí, como ver detalles de la orden -->
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Desvanecer y ocultar el mensaje después de 5 segundos
        $(".alert").delay(5000).fadeOut(500, function() {
            $(this).remove();
        });
    });
</script>

