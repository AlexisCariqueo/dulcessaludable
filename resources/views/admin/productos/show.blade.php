
@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">ID: {{ $producto->id }} Vista del Producto en la tienda</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-warning me-2">Editar</a>
                        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary float-end">Regresar</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="carouselExampleControls" class="carousel slide shadow rounded" data-bs-ride="carousel" style="max-width: 400px;">
                                <div class="carousel-inner">
                                    @foreach($imagenes as $key => $imagen)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url($imagen->ruta_imagen) }}" class="d-block w-100 rounded" alt="{{ $producto->name }}">
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
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $producto->name }}</h4>
                                    <p class="card-text">{{ $producto->descripcion }}</p>
                                    <p class="card-text">{{ $producto->categoria->nombre }}</p>
                                    <p class="card-text">Stock disponible: {{ $producto->stock }}</p>
                                    <div class="mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" max="{{ $producto->stock }}" value="1" readonly>
                                    </div>
                                    <h4 class="card-text">Precio: ${{ $producto->precio }}</h4>
                                    <button type="button" class="btn btn-primary" disabled>Agregar al carrito</button>
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
    </div>
</div>
@endsection
