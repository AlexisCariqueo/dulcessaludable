@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4">Editar producto</h1>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Regresar</a>
            <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $producto->name }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="categorias_id" class="form-label">Categoría</label>
                    <select class="form-select" id="categorias_id" name="categorias_id" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $producto->categorias_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}" min="0" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $producto->stock }}" min="0" required>
                </div>
                
                @foreach($producto->imagenes as $imagen)
                    <div class="form-group mt-2">
                        <img src="{{ Storage::url($imagen->ruta_imagen) }}" alt="Imagen de producto" width="200">
                        <input type="checkbox" name="delete_images[]" value="{{ $imagen->id }}">
                        <label for="delete_images[]">Eliminar</label>
                    </div>
                @endforeach

                <div class="mb-3">
                    <label for="imagenes">Agregar imágenes</label>
                    <input type="file" name="imagenes[]" multiple>
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>
@endsection
