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
                <div class="card-header">
                    <h3 class="card-title">Listado de Productos</h3>
                    <a href="{{ route('admin.productos.create') }}" class="btn btn-success float-end">Crear Producto</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
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
