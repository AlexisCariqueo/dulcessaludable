<!DOCTYPE html>
<html>
<head>
    <title>Tu Orden va en camino!</title>
</head>
<body>
    <div style="width: 100%; padding: 20px; background: #f8f9fa; color: #343a40;">
        <h1 style="color: #343a40;">Orden a fue Enviada a la Direccion de la Orden</h1>
        <p>Hola! {{ $user->name }},</p>

        <p>Su Orden ID <strong>{{ $order->id }}</strong> Esta en Camino!</p>
        Puede que el conductor te llame al número que está en tu perfil para avisarte que está a minutos de llegar, esperamos que disfrutes tu productos tanto como nosotros disfrutamos haciéndolo.</p>

        <h2>Detalles de Orden:</h2>
        @foreach($orderItems as $item)
        <div style="margin-bottom: 10px;">
            <strong>Nombre del Producto:</strong>
            @if ($item->producto)
                {{ $item->producto->name }}
            @else
                Producto no encontrado
            @endif
            <br>
            <strong>Cantidad:</strong> {{ $item->cantidad }}
        </div>
        @endforeach
        <p><strong>Total:</strong> {{ $order->total }}</p>

        <h2>Dirección de envío:</h2>
        <p>{{ $direccion->calle }} {{ $direccion->piso }}, {{ $direccion->comuna }}, {{ $direccion->codigo_postal }}</p>

        <h2>Número de teléfono:</h2>
        <p>{{ $telefono }}</p>
        
        <p>Gracias Por comprar con nosotros!</p>
    </div>
</body>
</html>
