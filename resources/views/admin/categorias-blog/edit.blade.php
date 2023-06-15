@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar categoría de blog</h5>
                    <a href="{{ route('admin.categorias-blog.index') }}" class="btn btn-secondary">Regresar</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categorias-blog.update', $categoria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
                        </div>
                        <button type="submit" class="btn btn-success float-end mt-3">Actualizar categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
