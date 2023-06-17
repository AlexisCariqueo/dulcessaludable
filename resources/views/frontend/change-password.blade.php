@extends('layouts.tienda-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <div class="card">
                <div class="card-header">{{ __('Cambiar Contraseña') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mt-3">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña actual') }}</label>
                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Tu contraseña debe tener al menos 8 caracteres, una letra minúscula, una letra mayúscula y un número.
                                </small>
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                            
                        </div>

                        <div class="form-group row">
                            <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar nueva contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

