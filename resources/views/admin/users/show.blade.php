@extends('layouts.admin-plantilla')

@section('title', 'Usuario '.$user->name)

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ $user->name }}</h3>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Correo electrónico:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Rol:</th>
                            <td>{{ $user->role->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Dirección del Usuario</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Calle:</th>
                            <td>{{ $user->direccion->calle }}</td>
                        </tr>
                        <tr>
                            <th>Comuna:</th>
                            <td>{{ $user->direccion->comuna }}</td>
                        </tr>
                        <tr>
                            <th>Ciudad:</th>
                            <td>{{ $user->direccion->ciudad }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Código Postal:</th>
                            <td>{{ $user->direccion->codigo_postal }}</td>
                        </tr>
                        <tr>
                            <th>Número:</th>
                            <td>{{ $user->direccion->numero }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Historial de Órdenes</h3>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID de Orden</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->estado }}</td>
                    <td>{{ $order->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
