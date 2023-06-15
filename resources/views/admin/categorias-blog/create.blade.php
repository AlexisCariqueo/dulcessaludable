@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Crear nueva categoría de blog</h5>
                    <a href="{{ route('admin.categorias-blog.index') }}" class="btn btn-secondary">Regresar</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categorias-blog.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la categoría</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success float-end">Crear categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
