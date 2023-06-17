@extends('layouts.tienda-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="card mb-4">
                    <div class="card-header">{{ __('Datos Personales') }}</div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>            

                <div class="card">
                    <div class="card-header">Dirección</div>
                    <div class="card-body">

                        <div class="form-group mt-3">
                            <label for="calle">Calle</label>
                            <input type="text" class="form-control" id="calle" name="calle" value="{{ old('calle', $user->direccion->calle ?? '') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="comuna">Comuna</label>
                            <input type="text" class="form-control" id="comuna" name="comuna" value="{{ old('comuna', $user->direccion->comuna ?? '') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="piso">Piso/Numeración</label>
                            <input type="number" class="form-control" id="piso" name="piso" value="{{ old('piso', $user->direccion->piso ?? '') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="codigo_postal">Código Postal</label>
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal', $user->direccion->codigo_postal ?? '') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero', $user->direccion->numero ?? '') }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-personalizado">Actualizar perfil y dirección</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
