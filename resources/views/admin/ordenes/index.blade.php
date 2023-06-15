@extends('layouts.admin-plantilla')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (session('email_status'))
                    <div class="alert alert-success">
                        {{ session('email_status') }}
                    </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title">Listado de Órdenes</h3>
                </div>
                <div class="card-header">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Filtros de búsqueda
                        </button>
                    </h2>
                    <div class="accordion" id="filterAccordion">
                        <div class="accordion-item">
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <form action="{{ route('admin.ordenes.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="searchId" class="form-control mb-2" placeholder="Buscar por ID..." value="{{ request()->get('searchId') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="searchName" class="form-control mb-2" placeholder="Buscar por nombre..." value="{{ request()->get('searchName') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="searchDate" class="form-control mb-2" placeholder="Buscar por mes y año (MM-YYYY)..." value="{{ request()->get('searchDate') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="searchStatus" class="form-control mb-2">
                                                    <option value="">Todos los estados</option>
                                                    <option value="null" {{ request()->get('searchStatus') === 'null' ? 'selected' : '' }}>No pagado</option>
                                                    <option value="pendiente" {{ request()->get('searchStatus') === 'pendiente' ? 'selected' : '' }}>pendiente</option>
                                                    <option value="pagado" {{ request()->get('searchStatus') === 'pagado' ? 'selected' : '' }}>Pagado</option>
                                                    <option value="enviando" {{ request()->get('searchStatus') === 'enviando' ? 'selected' : '' }}>enviando</option>
                                                    <option value="entregado" {{ request()->get('searchStatus') === 'entregado' ? 'selected' : '' }}>entregado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-secondary float-end" type="submit">Buscar</button>
                                                <a href="{{ route('admin.ordenes.index') }}" class="btn btn-secondary float-end me-2">Limpiar</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Comprobante de Transferencia</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr data-order-id="{{ $order->id }}">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if($order->transfer_proof)
                                            <a href="{{ asset('storage/' . $order->transfer_proof) }}" target="_blank">
                                                Ver Comprobante
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $order->estado ?? 'No Pagado' }}</td>
                                    <td>
                                        @if(empty($order->transfer_proof))
                                            <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> 
                                                </button>
                                            </form>
                                        @else
                                        <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 
                                        </a>                                        
                                        @endif
                                    </td>                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
