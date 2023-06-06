@extends('layouts.admin-plantilla')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Panel de Administración</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-header">
                    Usuarios
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{ $userCount }}</h3>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Ver Usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-header">
                    Productos
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{ $productCount }}</h3>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Ver Productos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center mb-4">
                <div class="card-header">
                    Blog
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{$PostCount}}</h3>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-primary">Ver Blog</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card text-center mb-4">
                <div class="card-header">
                    Órdenes
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="row justify-content-center align-items-start mt-4">
                        <div class="col-md-2">
                            <div class="card text-center mb-4">
                                <div class="card-header">
                                    No Pagadas
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $orderCounts['noPaid'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center mb-4">
                                <div class="card-header">
                                    Pendientes
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $orderCounts['pending'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center mb-4">
                                <div class="card-header">
                                    Pagadas
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $orderCounts['paid'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center mb-4">
                                <div class="card-header">
                                    Enviadas
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $orderCounts['sent'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center mb-4">
                                <div class="card-header">
                                    Entregadas
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $orderCounts['completed'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.ordenes.index') }}" class="btn btn-primary mt-4 align-self-center">Ver Órdenes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

