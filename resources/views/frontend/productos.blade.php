@extends('layouts.tienda-plantilla')

@section('content')

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/tienda/logocarru.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/tienda/carru2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/tienda/carru3.jpg') }}" class="d-block w-100" alt="...">
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Filtrar</div>
                    <div class="card-body">
                        <h5 class="card-title">Stock</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="stockFilter">
                            <label class="form-check-label" for="stockFilter">
                                Mostrar solo productos con stock
                            </label>
                        </div>
                        <h5 class="card-title mt-4">Tipo de producto</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tortaEnteraFilter">
                            <label class="form-check-label" for="tortaEnteraFilter">
                                Mostrar solo tortas enteras
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="porcionTortaFilter">
                            <label class="form-check-label" for="porcionTortaFilter">
                                Mostrar solo porciones de torta
                            </label>
                        </div>
                        <button class="btn btn-primary mt-4 custom-button" id="aplicarFiltro">Aplicar filtro</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h2>Todos los Productos</h2>
                <div class="row">
                    @foreach($productos as $producto)
                        <div class="col-md-4 mb-4 card-container">
                            <div class="card h-100">
                                @php
                                    $imagenCount = $producto->imagenes->count();
                                @endphp

                                @if($imagenCount > 0)
                                    <div id="productoCarousel{{$producto->id}}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($producto->imagenes as $index => $imagen)
                                                <div class="carousel-item @if($index == 0) active @endif">
                                                    <!-- Añade un hipervínculo a la imagen -->
                                                    <a href="{{ route('productos.show', $producto->id) }}">
                                                        <img src="{{ Storage::url($imagen->ruta_imagen) }}" class="card-img-top" alt="{{ $producto->name }}">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Controles del carrusel (sin hipervínculos) -->
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
                                    <!-- Añade un hipervínculo a la imagen de relleno -->
                                    <a href="{{ route('productos.show', $producto->id) }}">
                                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $producto->name }}">
                                    </a>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->name }}</h5>
                                    <p class="card-text">{{ $producto->descripcion }}</p>
                                    <h5>${{ $producto->precio }}</h5>
                                    <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="cantidad" class="form-label">Cantidad</label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" max="{{ $producto->stock }}" value="1">
                                        </div>
                                        <input type="hidden" name="productos_id" value="{{ $producto->id }}">
                                        <button type="submit" class="btn btn-primary boton-personalizado">Agregar al carrito</button>
                                    </form>
                                    <input type="hidden" class="stock" value="{{ $producto->stock }}">
                                    <input type="hidden" class="tipo-producto" value="{{ $producto->categorias_id }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($productos instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $productos->links() }}
                @endif
            </div>
        </div>
    </div>


    <style>
        .boton-personalizado {
            background-color: #f18770;
            color: white;
            border: 2px solid #f18770;  /* Define el grosor y color del borde aquí */
            border-radius: 5px;  /* Define el radio del borde (esquinas redondeadas) aquí */
        }

        .boton-personalizado:hover {
            background-color: #b36b50;
            color: white;
            border-color: #b36b50;  /* Cambia el color del borde en hover */
        }

        .custom-button {
            /* Agrega aquí tus estilos personalizados */
            background-color: #f18770;
            color: #fff;
            border: none;
        /* Otros estilos personalizados que desees aplicar */
        }

    </style>


   <script>
        // Filtrar productos
        var stockFilter = document.getElementById('stockFilter');
        var tortaEnteraFilter = document.getElementById('tortaEnteraFilter');
        var porcionTortaFilter = document.getElementById('porcionTortaFilter');
        var aplicarFiltroButton = document.getElementById('aplicarFiltro');
        var cardContainers = document.querySelectorAll('.card-container');

        aplicarFiltroButton.addEventListener('click', function() {
            cardContainers.forEach(function(cardContainer) {
                var stock = cardContainer.querySelector('.stock').value;
                var tipoProducto = cardContainer.querySelector('.tipo-producto').value;
                var show = true;

                if (stockFilter.checked && stock == 0) {
                    show = false;
                }
                if (tortaEnteraFilter.checked && tipoProducto != '1') {
                    show = false;
                }
                if (porcionTortaFilter.checked && tipoProducto != '2') {
                    show = false;
                }

                cardContainer.style.display = show ? 'block' : 'none';
            });
        });

        // Mostrar todos los productos
        var todosProductosFilter = document.getElementById('todosProductosFilter');
        todosProductosFilter.addEventListener('change', function() {
            cardContainers.forEach(function(cardContainer) {
                cardContainer.style.display = todosProductosFilter.checked ? 'block' : 'none';
            });
        });

    </script>

@endsection
