@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Editar Categoría del Blog</h2>
            <form action="{{ route('admin.categorias-blog.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar categoría</button>
            </form>
        </div>
    </div>
</div>
@endsection
