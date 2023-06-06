@extends('layouts.admin-plantilla')


@section('content')

<head>
	<title>Lista de Usuarios</title>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de Usuarios</h3>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success float-end">Crear Usuario</a>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Editar</a>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
