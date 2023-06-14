@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categorías del Blog</h3>
                    <a href="{{ route('admin.categorias-blog.create') }}" class="btn btn-success mb-3 float-end">Crear nueva categoría</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th> 
                                    <th class="d-flex justify-content-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                    <tr>
                                        <td>{{ $categoria->id }}</td>
                                        <td>{{ $categoria->nombre }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('admin.categorias-blog.edit', $categoria->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                                <form action="{{ route('admin.categorias-blog.destroy', $categoria->id) }}" method="POST" class="d-inline ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
