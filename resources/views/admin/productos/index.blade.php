@extends('layouts.admin-plantilla')
@php
    use Illuminate\Support\Str;
@endphp
@section('content')

<head>
    <title>Lista de Productos</title>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Listado de Productos</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.productos.create') }}" class="btn btn-success">Crear Producto</a>
                    </div>
                </div>
                <div class="card-header">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Filtros de búsqueda
                        </button>
                    </h2>
                    <div class="accordion" id="filterAccordion">
                        <div class="accordion-item">
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <form action="{{ route('admin.productos.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="searchName" class="form-control mb-2" placeholder="Buscar por nombre..." value="{{ request()->get('searchName') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="searchPrice" class="form-control mb-2" placeholder="Buscar por precio..." value="{{ request()->get('searchPrice') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select name="searchStock" class="form-control mb-2">
                                                    <option value="">Todos</option>
                                                    <option value="con" {{ request()->get('searchStock') === 'con' ? 'selected' : '' }}>Con Stock</option>
                                                    <option value="sin" {{ request()->get('searchStock') === 'sin' ? 'selected' : '' }}>Sin Stock</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-secondary" type="submit">Buscar</button>
                                                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Limpiar</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>              
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Actualización</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->name }}</td>
                                    <td>${{ $producto->precio }}</td>
                                    <td>{{ $producto->stock }}</td>
                                    <td>{{ Str::limit($producto->descripcion, 20) }}</td>
                                    <td>{{ $producto->created_at }}</td>
                                    <td>{{ $producto->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.productos.show', $producto->id) }}" class="btn btn-sm btn-success">Ver</a>
                                        <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                        <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $productos->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
