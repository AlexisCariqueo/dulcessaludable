@extends('layouts.admin-plantilla')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Detalles de la Orden
                </div>
                <div class="card-body">
                    <p>Número de Orden: {{ $order->id }}</p>
                    <p>Fecha: {{ $order->created_at }}</p>
                    <p>Estado: {{ $order->estado }}</p>
                    <p>Total: {{ $order->total }}</p>
                    @if($order->transfer_proof)
                        <p><a href="{{ asset('storage/' . $order->transfer_proof) }}" target="_blank">Ver Comprobante de Transferencia</a></p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Detalles del Cliente
                </div>
                <div class="card-body">
                    <p>Nombre del Cliente: {{ $order->user->name }}</p>
                    <p>Email del Cliente: {{ $order->user->email }}</p>
                    <p>Dirección de Envío: {{ $order->user->direccion->calle }}, {{ $order->user->direccion->piso }}, {{ $order->user->direccion->comuna }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Detalles de los Productos
                </div>
                <div class="card-body">
                    @foreach($order->orderItems as $item)
                        <p>Nombre del Producto: {{ $item->producto->name }}</p>
                        <p>Cantidad: {{ $item->cantidad }}</p>
                        <p>Precio: {{ $item->producto->precio }}</p>
                    @endforeach
                </div>                            
            </div>

            <div class="card">
                <div class="card-header">
                    Cambio de Estado de la Orden
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.order.changeStatus', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="orderStatus">Nuevo estado de la orden:</label>
                            <select id="orderStatus" class="form-control" name="estado">
                                @foreach($orderStatuses as $status)
                                    <option value="{{ $status }}" {{ $order->estado == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Actualizar estado de la orden</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
