<!DOCTYPE html>
<html>
<head>
    <title>Orden Recibida!</title>
</head>
<body>
    <div style="width: 100%; padding: 20px; background: #f8f9fa; color: #343a40;">
        <h1 style="color: #343a40;">Orden en Estado Pendiente</h1>
        <p>Hola! {{ $user->name }},</p>

        <p>Su Orden ID {{ $order->id }} Esta en estado Pendiente, esto quiere decir que nos estamos encargando de revisar la transferencia realizada, cuando se comfirme el pago la orden pasada al estado de Pagado y se procedera al envio.</p>

        <h2>Detalles de Orden:</h2>
        @foreach($orderItems as $item)
            <div style="margin-bottom: 10px;">
                <strong>Nombre del Producto:</strong> {{ $item->producto->name }} <br>
                <strong>Cantidad:</strong> {{ $item->cantidad }}
            </div>
        @endforeach

        <p><strong>Total:</strong> {{ $order->total }}</p>

        <p>Gracias Por compras con nosotros!</p>
    </div>
</body>
</html>
