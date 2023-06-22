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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <small id="passwordHelp" class="form-text text-muted">
                                  La contraseña debe tener al menos 8 caracteres, al menos una letra minúscula, una mayúscula y un número.
                                </small>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Repetir Contraseña:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role_id">Rol:</label>
                                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
