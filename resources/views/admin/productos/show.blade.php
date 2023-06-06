@extends('layouts.admin-plantilla')

@section('content')
<div class="container mt-5">
    <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Regresar</a>
    <div class="row">
        <div class="col-md-6">
            <h2>Nombre del Producto:</h2>
            <p> {{ $producto->name }}</p>
            <h4 class="mt-3">Descripción:</h4>
            <p>{{ $producto->descripcion }}</p>
            <h4 class="mt-3">Categoria:</h4>
            <p>{{($producto->categoria)->nombre }}</p>
            <h4>Precio: ${{ $producto->precio }}</h4>
            <h4>Stock disponible: {{ $producto->stock }}</h4>
        </div>
        <div class="col-md-6">
            <div id="carouselExampleControls" class="carousel slide shadow rounded" data-bs-ride="carousel" style="max-width: 400px;"> <!-- Ajusta el valor de max-width según lo desees -->
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
    </div>
</div>
@endsection
