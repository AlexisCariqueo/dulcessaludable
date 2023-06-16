@extends('layouts.tienda-plantilla')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($imagenes as $key => $imagen)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url($imagen->ruta_imagen) }}" class="d-block w-100" alt="{{ $producto->name }}">
                                        </div>
                                    @endforeach
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
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h4 class="card-title">{{ $producto->name }}</h4>
                                <p class="card-text">{{ $producto->descripcion }}</p>
                                <p class="card-text">{{ $producto->categoria->nombre }}</p>
                                <p class="card-text">Stock disponible: {{ $producto->stock }}</p>
                                <form action="{{ route('cart.add') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" max="{{ $producto->stock }}" value="1">
                                    </div>
                                    <h4 class="card-text">Precio: ${{ $producto->precio }}</h4>
                                    <input type="hidden" name="productos_id" value="{{ $producto->id }}">
                                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                </form>
                                <div class="mt-3">
                                    <p>
                                        <strong>Importante:</strong> Una vez realizada la compra, el producto será enviado en un plazo de 24 horas. Por favor, ten en cuenta este plazo al realizar tu compra.
                                        Si tienes alguna pregunta o inquietud, no dudes en contactarnos a través de correo electrónico a panaderiaypasteleria.olivias@gmail.com.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


