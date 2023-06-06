@extends('layouts.tienda-plantilla')

@section('content')
<div class="container">
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <h1 class="mb-4">Carrito de compras</h1>

    <div class="table-responsive">
        <table class="table table-light">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $item)
                    @if(isset($item->producto))
                        <tr>
                            <td>{{ $item->producto->name }}</td>
                            <td>{{ $item->producto->precio }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->producto->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm w-auto me-2">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                                </form>                    
                            </td>
                            <td>{{ $item->producto->precio * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>                    
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm w-auto me-2">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                                </form>                    
                            </td>
                            <td>{{ $item['price'] * $item['quantity'] }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>                    
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="5">Tu carrito está vacío.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> 

    <div class="text-end">
        <h4>Total: ${{ $total }}</h4>
        @if(count($cartItems) > 0)
        <a href="{{ route('frontend.direccion') }}" class="btn btn-proceder">Proceder al pago</a>
        @else
            <small class="form-text text-muted">Para comprar, debes iniciar sesión o registrarte.</small>
        @endif
    </div>
    
</div>
@endsection
