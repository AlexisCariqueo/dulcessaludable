@extends('layouts.tienda-plantilla')

@section('content')
<div class="container">

    <div class="card mt-3">
        <div class="card-header">
            <h3>Detalles de la Orden</h3>
        </div>
        <div class="card-body">
            <h4>Número de Orden: {{ $order->id }}</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->producto->name }}</td>
                <td>{{ $producto->cantidad }}</td>
                <td>{{ $producto->precio }}</td>
            </tr>
        @endforeach
                </tbody>
            </table>
            <div class="text-left">
                <h4>Total: ${{ $order->total }}</h4>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <h3>Detalles de Transferencia</h3>
                </div>
                <div class="card-body">
                    <p>Banco: Banco Estado</p>
                    <p>Cuenta Bancaria: 123456789</p>
                    <p>Tipo de Cuenta: Cuenta Corriente</p>
                    <p>Nombre: Olivia Pastelera</p>
                    <p>Correo: panaderiaypasteleria.olivias@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Comprobante de Pago</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                    
                    <p>*Debes Subir el comprobante de pago de su transferencia, el que se genera al finalizar el pago</p>
                    <p>*Archivos aceptados:jpg,png,pdf con peso maximo de:2mb</p>
                    <p>*Recuerda que debe aparecer el valor, el correo de la empresa y si quiere puedes poner en comentarios el N de Orden</p>
                    <form method="POST" action="{{ route('transfer.proof', ['order' => $order->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <div class="form-group">
                            <label for="proof">Subir prueba de transferencia:</label>
                            <input type="file" id="proof" name="proof" required>
                        </div>
                        <button type="submit" class="btn btn-finalizar-compra">Finalizar compra</button>
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
@if ($errors->has('proof'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('proof') }}</strong>
    </span>
@endif


<style>
    .btn-finalizar-compra {
        background-color: #f18770;
        border-color: #f18770;
    }

    .btn-finalizar-compra:hover {
        background-color: #d86850;
        border-color: #d86850;
    }
</style>
@endsection

