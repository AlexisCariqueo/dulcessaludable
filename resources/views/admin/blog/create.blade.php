@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <a href="{{ route('admin.blog.index') }}" class="btn btn-primary">Regresar</a>
    <div class="row">
        <div class="col-md-12">
            <br>
            <h2 class="mb-4">Crear nueva entrada de blog</h2>
            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="excerpt">Extracto</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" class="form-control" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    <label for="featured_image">Imagen destacada</label>
                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tags">Etiquetas (separadas por comas)</label>
                    <input type="text" name="tags" id="tags" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="publicado">Publicado</option>
                        <option value="borrador" selected>Borrador</option>
                        <option value="archivado">Archivado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Crear entrada</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('excerpt');
        CKEDITOR.replace('content');
    });
</script>
@endpush
