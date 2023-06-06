@extends('layouts.admin-plantilla')

@section('title', 'Usuario '.$user->name)

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
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
@endsection
