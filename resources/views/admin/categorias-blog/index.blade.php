@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row" >
        <div class="col-md-12">
            <h2 class="mb-4">Categorías del Blog</h2>
            <a href="{{ route('admin.categorias-blog.create') }}" class="btn btn-primary mb-3">Crear nueva categoría</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>
                                <a href="{{ route('admin.categorias-blog.edit', $categoria->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('admin.categorias-blog.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
