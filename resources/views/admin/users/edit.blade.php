@extends('layouts.admin-plantilla')

@section('title', 'Crear Usuario')

@section('content')
<dir>
    <br>
</dir>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title"> Crear Usuario</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-end">Regresar</a>
                        </div>
                    </div>
                    <div class="card-body">

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
                            <br>
                            <button type="submit" class="btn btn-success float-end">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

