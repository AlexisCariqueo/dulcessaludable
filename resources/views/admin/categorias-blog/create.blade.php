@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.categorias-blog.index') }}" class="btn btn-primary">Regresar</a>
            <h2 class="mb-4">Crear nueva categoría de blog</h2>
            <form action="{{ route('admin.categorias-blog.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre de la categoría</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Crear categoría</button>
            </form>
        </div>
    </div>
</div>
@endsection