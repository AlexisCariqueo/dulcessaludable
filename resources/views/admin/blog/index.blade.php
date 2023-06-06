@extends('layouts.admin-plantilla')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Lista de entradas de blog</h2>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-success mb-3">Crear nueva entrada</a>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive"> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Categoría</th>
                                <th>Estado</th>
                                <th>Fecha de publicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->categoria->nombre}}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.blog.show', $post->id) }}" class="btn btn-sm btn-success">Ver</a>
                                        <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                        <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta entrada?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
@endsection
