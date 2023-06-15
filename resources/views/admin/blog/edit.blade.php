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
                    <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group mt-3">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="categoria_id">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $post->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="excerpt">Extracto</label>
                            <textarea name="excerpt" id="excerpt" class="form-control" rows="3">{{ $post->excerpt }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="content">Contenido</label>
                            <textarea name="content" id="content" class="form-control" rows="10" required>{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="featured_image">Imagen Ingresada</label>
                            @if ($post->featured_image)
                                <img src="{{ asset($post->featured_image) }}" alt="Imagen" class="img-thumbnail mt-3" width="200">
                                <div>
                                    <a href="{{ route('admin.blog.deleteImage', $post->id) }}" class="btn btn-danger mt-3">Borrar imagen</a>

                                </div>
                            @else
                                <input type="file" name="featured_image" id="featured_image" class="form-control">
                            @endif
                        </div>
                        <div class="form-group mt-3">
                            <label for="tags">Etiquetas (separadas por comas)</label>
                            <input type="text" name="tags" id="tags" class="form-control" value="{{ $post->tags }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="status">Estado</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="publicado" {{ $post->status == 'publicado' ? 'selected' : '' }}>Publicado</option>
                                <option value="borrador" {{ $post->status == 'borrador' ? 'selected' : '' }}>Borrador</option>
                                <option value="archivado" {{ $post->status == 'archivado' ? 'selected' : '' }}>Archivado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success float-end mt-3">Actualizar entrada</button>
                </form>
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
