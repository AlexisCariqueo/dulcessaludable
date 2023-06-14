@extends('layouts.admin-plantilla')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title">Lista de entradas de blog</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-success">Crear nueva entrada</a>
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
                                        <form action="{{ route('admin.blog.index') }}" method="GET">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="searchId" class="form-control mb-2" placeholder="Buscar por ID..." value="{{ request()->get('searchId') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="searchTitle" class="form-control mb-2" placeholder="Buscar por título..." value="{{ request()->get('searchTitle') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="searchCategory" class="form-control mb-2" placeholder="Buscar por categoría..." value="{{ request()->get('searchCategory') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="searchStatus" class="form-control mb-2" placeholder="Buscar por estado..." value="{{ request()->get('searchStatus') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Limpiar</a>
                                                    <button class="btn btn-secondary" type="submit">Buscar</button>
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
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
