@extends('layouts.admin-plantilla')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.blog.index') }}" class="btn btn-primary">Regresar</a>
                <h2 class="mb-4">{{ $post->title }}</h2>
                <p class="mt-4"><strong>Titulo:</strong> {!! $post->title !!}</p>
                @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="post-image">
                @endif
                <p class="mt-4"><strong>Bajada:</strong> {!! $post->excerpt !!}</p>
                <p><strong>Contenido:</strong></p>
                <div>{!! $post->content !!}</div>
                <p>Autor: {{ $post->user ? $post->user->name : 'Desconocido' }}</p>
                <p><strong>Fecha de publicación:</strong> {{ $post->published_at }}</p>
                <p><strong>Categoría:</strong>
                    @if($post->categoria)
                        {{ $post->categoria->nombre }}
                    @else
                        Sin categoría
                    @endif
                </p>
                <p><strong>Categoría ID:</strong>
                    @if($post->categoria_id)
                        {{ $post->categoria_id }}
                    @else
                        No asignado
                    @endif
                </p>
                
                <p><strong>Etiquetas:</strong> {{ $post->tags }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($post->status) }}</p>
                
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('excerpt', { readOnly: true });
        CKEDITOR.replace('content', { readOnly: true });
    });
    
</script>
<style>
    .post-image {
    width: 50%;  
    height: auto; 
}
</style>
@endpush
