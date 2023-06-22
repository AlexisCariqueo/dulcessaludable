@extends('layouts.tienda-plantilla')
@php
    use Illuminate\Support\Str;
@endphp
@section('content')

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('/storage/storage/tienda/logocarru.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/storage/storage/tienda/carru2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/storage/storage/tienda/carru3.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
    </div>
    @endif

    @if (auth()->check() && auth()->user()->orders()->whereNull('estado')->exists())
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="order-pending-message">
            Tienes una orden pendiente de pago. Por favor, realiza el pago en <a href="{{ route('profile') }}">Mis Órdenes</a>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-5">
        <h2>Productos destacados</h2>
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-2 mb-4">
                    <div class="card h-100">
                        @php
                            $imagenCount = $producto->imagenes->count();
                        @endphp

                        @if($imagenCount > 0)
                            <div id="productoCarousel{{$producto->id}}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($producto->imagenes as $index => $imagen)
                                        <div class="carousel-item @if($index == 0) active @endif">
                                            <a href="{{ route('productos.show', $producto->id) }}">
                                                <img src="{{ Storage::url($imagen->ruta_imagen) }}" class="card-img-top" alt="{{ $producto->name }}" style="height: 180px; width: auto; object-fit: cover;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#productoCarousel{{$producto->id}}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productoCarousel{{$producto->id}}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>
                        @else
                            <a href="{{ route('productos.show', $producto->id) }}">
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $producto->name }}">
                            </a>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->name }}</h5>
                            <td>{{ Str::limit($producto->descripcion, 20) }}</td>
                            <h5>${{ $producto->precio }}</h5>
                            <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" max="{{ $producto->stock }}" value="1">
                                </div>
                                <input type="hidden" name="productos_id" value="{{ $producto->id }}">
                                <button type="submit" class="btn btn-primary boton-personalizado" {{ $producto->stock <= 0 ? 'disabled' : '' }}>
                                    {{ $producto->stock <= 0 ? 'Producto sin stock' : 'Agregar al carrito' }}
                                </button>                                
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($productos instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $productos->links('pagination::bootstrap-5') }}
        @endif
    </div>

    <div class="container mt-5 sobre-nosotros">
        <h2>Pedidos Personalizados</h2>
        <p>Somos una tienda de pasteles y postres que ofrece deliciosos productos horneados con ingredientes de alta calidad. Y sabemos que cada cliente es especial y en caso de que el producto que necesites no esté en nuestra selección puedes mandar un correo a panaderiaypasteleria.olivias@gmail.com preguntando sobre el producto que necesitas.</p>
    </div>
    <style>
        .boton-personalizado {
            background-color: #f18770;
            color: white;
            border: 2px solid #f18770;
            border-radius: 5px; 
        }
    
        .boton-personalizado:hover {
            background-color: #b36b50;
            color: white;
            border-color: #b36b50;  
        }
    
        .sobre-nosotros {
            background-color: #f18770;
            border: 2px solid #f18770;  
            border-radius: 5px;  
        }
    
        .sobre-nosotros:hover {
            background-color: #b36b50;
            border-color: #b36b50;  
        }
        .pagination .page-link {
            color: rgb(0, 0, 0);
            border: none; 
        }

        .pagination .page-item.active .page-link {
            background-color: #b36b50;
            border: none;
        }

   
        
        .card-img-top {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        @media screen and (max-width: 768px) {
            .card-img-top {
                width: 100%;
                min-height: 400px; // Set a minimum height here
                object-fit: scale-down;
            }
        }
      

  

            
    </style>
    
    <script>
        setTimeout(function() {
            var orderPendingMessage = document.getElementById('order-pending-message');
            if (orderPendingMessage) {
                orderPendingMessage.classList.remove('show');
            }
        }, 5000);
    </script>
    
@endsection
