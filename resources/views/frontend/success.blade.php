@extends('layouts.tienda-plantilla')

@section('content')
    <h1>Compra realizada con éxito</h1>
    
    @if($order)
    <p>Id de la compra: {{ $order->id }}</p>
    {{ $order->id }}
@endif
    <p>Método de pago: {{ $order->payment_method }}</p>
    <p>Dirección de envío: {{ $order->shipping_address }}</p>
    <p>Email: {{ $order->user->email }}</p>
    <h2>Productos:</h2>
    <ul>
        @foreach($order->products as $product)
            <li>{{ $product->name }}: {{ $product->price }}</li>
        @endforeach
    </ul>
    
@endsection
