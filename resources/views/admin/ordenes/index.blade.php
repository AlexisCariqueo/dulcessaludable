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
                                                    <i class="fas fa-trash"></i> <!-- Icono de basura -->
                                                </button>
                                            </form>
                                        @else
                                        <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> <!-- Icono de vista -->
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.order-status').change(function() {
            var status = $(this).val();
            var order_id = $(this).closest('tr').data('order-id');
    
            $.ajax({
                url: "/admin/order/" + order_id + "/updateOrderStatus",
                type: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'estado': status   
                },
                success: function(response) {
                    alert('Estado de la orden actualizado con éxito.');
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Algo salió mal al actualizar el estado de la orden.');
                }
            });
        });
    });
</script>

@endsection
