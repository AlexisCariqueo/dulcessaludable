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
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Repetir Contraseña:</label>
                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
                              </div>
                            <div class="form-group">
                                <label for="role_id">Rol:</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success float-end">Crear usuario</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

