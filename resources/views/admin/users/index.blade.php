@extends('layouts.admin-plantilla')

@section('content')

<head>
    <title>Lista de Usuarios</title>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Listado de Usuarios</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-success float-end">Crear Usuario</a>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Filtros de búsqueda
                        </button>
                    </h2>
                    <div class="accordion" id="filterAccordion">
                        <div class="accordion-item">
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <form action="{{ route('admin.users.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="searchId" class="form-control mb-2" placeholder="Buscar por ID..." value="{{ request()->get('searchId') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="searchName" class="form-control mb-2" placeholder="Buscar por nombre..." value="{{ request()->get('searchName') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="searchEmail" class="form-control mb-2" placeholder="Buscar por email..." value="{{ request()->get('searchEmail') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="searchRole" class="form-control mb-2" placeholder="Buscar por rol..." value="{{ request()->get('searchRole') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-success float-end" type="submit">Buscar</button>
                                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-end me-2">Limpiar</a>
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
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name ?? '' }}</td>
                                    <td>{{ $user->email ?? '' }}</td>
                                    <td>{{ $user->role->name ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-success">Ver</a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
