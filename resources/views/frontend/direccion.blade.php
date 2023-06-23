@extends('layouts.tienda-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Dirección de Envío') }}</div>
                <div class="alert alert-info" role="alert">
                    Por favor ten en cuenta que sólo hacemos envíos dentro de la Región Metropolitana y que el tiempo de entrega es de 24 horas a partir de la confirmación del pago.
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('direccion.store') }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="form-group row">
                            <label for="calle" class="col-md-4 col-form-label text-md-right">{{ __('Calle') }}</label>

                            <div class="col-md-6">
                                <input id="calle" type="text" class="form-control @error('calle') is-invalid @enderror" name="calle" value="{{ old('calle', auth()->user()->direccion->calle ?? '') }}" required autocomplete="calle" autofocus>

                                @error('calle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Número de Teléfono') }}</label>

                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero', auth()->user()->direccion->numero ?? '') }}" required autocomplete="numero">

                                @error('numero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label for="piso" class="col-md-4 col-form-label text-md-right">{{ __('N° casa/dept') }}</label>

                            <div class="col-md-6">
                                <input id="piso" type="text" class="form-control @error('piso') is-invalid @enderror" name="piso" value="{{ old('piso', auth()->user()->direccion->piso ?? '') }}" autocomplete="piso">

                                @error('piso')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label for="comuna" class="col-md-4 col-form-label text-md-right">{{ __('Comuna') }}</label>

                            <div class="col-md-6">
                                <input id="comuna" type="text" class="form-control @error('comuna') is-invalid @enderror" name="comuna" value="{{ old('comuna', auth()->user()->direccion->comuna ?? '') }}" required autocomplete="comuna">

                                @error('comuna')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label for="codigo_postal" class="col-md-4 col-form-label text-md-right">{{ __('Código Postal') }}</label>

                            <div class="col-md-6">
                                <input id="codigo_postal" type="text" class="form-control @error('codigo_postal') is-invalid @enderror" name="codigo_postal" value="{{ old('codigo_postal', auth()->user()->direccion->codigo_postal ?? '') }}" required autocomplete="codigo_postal">

                                @error('codigo_postal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 d-flex justify-content-between">
                                <a href="{{ route('cart.index') }}" class="btn btn-volver">Volver al carrito</a>
                                <button type="submit" class="btn btn-pagar">{{ __('Pagar') }}</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
