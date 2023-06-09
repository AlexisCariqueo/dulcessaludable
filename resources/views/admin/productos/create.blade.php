
@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Agregar Producto</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary float-end">Regresar</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
        
                        <div class="mb-3">
                            <label for="categorias_id" class="form-label">Categoría</label>
                            <select class="form-select" id="categorias_id" name="categorias_id" required>
                                <option value="">Seleccione una Categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categorias_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                            </select>
                        </div>
        
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="imagen1" class="form-label">Imagen Principal (Obligatoria)</label>
                            <input type="file" class="form-control" id="imagen1" name="imagenes[]" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="imagen2" class="form-label">Imagen 2 (opcional)</label>
                            <input type="file" class="form-control" id="imagen2" name="imagenes[]" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="imagen3" class="form-label">Imagen 3 (opcional)</label>
                            <input type="file" class="form-control" id="imagen3" name="imagenes[]" accept="image/*">
                        </div>

                            <button type="submit" class="btn btn-success float-end">Guardar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
