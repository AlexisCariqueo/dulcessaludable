@extends('layouts.admin-plantilla')

@section('title', 'Editar Usuario')

@section('content')
    <div class="container">
        <h1 class="text-center">Editar usuario</h1>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
            </div>
            <div class="form-group">
                <label for="role_id">Rol</label>
                <select class="form-control" id="role_id" name="role_id">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
