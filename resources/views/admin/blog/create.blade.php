@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Crear nueva entrada de blog</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary float-end">Regresar</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="categoria_id">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="excerpt">Extracto</label>
                            <textarea name="excerpt" id="excerpt" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="content">Contenido</label>
                            <textarea name="content" id="content" class="form-control" rows="10" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="featured_image">Imagen destacada</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control-file">
                        </div>
                        <div class="form-group mt-3">
                            <label for="tags">Etiquetas (separadas por comas Ej: etiqueta,etiqueta1)</label>
                            <input type="text" name="tags" id="tags" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="status">Estado</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="publicado">Publicado</option>
                                <option value="borrador" selected>Borrador</option>
                                <option value="archivado">Archivado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success float-end mt-3">Crear entrada</button>
                    </form>
                </div>
            </div>
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
