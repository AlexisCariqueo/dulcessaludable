@extends('layouts.tienda-plantilla')

@section('content')
<div class="container">

    @if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

    <!-- Carrito de Compras -->
    <div class="card mt-3">
        <div class="card-header">
            <h3>Carrito</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->producto->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->quantity * $item->producto->precio }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-left">
            <h4>Total: ${{ $total }}</h4>
        </div>
    </div>


 <div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Datos de envío</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Nombre:</span>
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">    
                            <span>Email:</span>
                            <span>{{ auth()->user()->email }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Calle:</span>
                            <span>{{ $direccion->calle ?? '' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="display: flex; justify-content: space-between;">
                            <span>N° casa/dept:</span>
                            <span>{{ $direccion->piso ?? '' }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Ciudad:</span>
                            <span>{{ $direccion->comuna ?? '' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Código postal:</span>
                            <span>{{ $direccion->codigo_postal ?? '' }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Teléfono:</span>
                            <span>{{ $direccion->numero ?? '' }}</span>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Método de Pago -->
        <div class="card">
            <div class="card-header">
                <h3>Método de Pago</h3>
            </div>
            <div class="card-body">
                <input type="hidden" name="amount" value="{{ $total }}">
                {{-- <form method="POST" action="{{ route('checkout.process') }}">
                    @csrf                
                    <input type="hidden" name="amount" value="{{ $total }}">
                    <!-- Otros campos del formulario aquí -->
                    <div class="button-container">
                        <button type="submit" class="custom-button" name="payment-method" value="flow">
                            <img src="{{ asset('/storage/storage/tienda/flow-manualesdigitales.jpg') }}" alt="Botón 1">
                        </button>
                    </div>
                </form> --}}

                <!-- Formulario para el método de pago "transferencia" -->
                <form method="POST" action="{{ route('frontend.checkout.processPayment') }}">
                    @csrf
                    <div class="button-container">
                        <button type="submit" class="custom-button" name="payment-method" value="transferencia">
                            <img src="{{ asset('/storage/storage/tienda/logo-transferencia.png') }}" alt="Botón 2">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Botones de Acción -->
    <div class="row mt-3">
        <div class="col-md-6">
            <a href="{{ route('frontend.direccion') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection

<style>
    .button-container {
        display: flex; 
        justify-content: center;
        align-items: center; 
    }

    .custom-button {
        padding: 0; 
        border: none; 
        margin-right: 10px; 
    }

    .custom-button:last-child {
        margin-right: 0; 
    }

    .custom-button img {
        width: 200px; 
        height: auto; 
    }
</style>

