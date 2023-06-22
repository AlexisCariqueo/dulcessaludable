@extends('layouts.admin-plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Vista de la entrada ID: {{ $post->id }}</h5>
                    <div>
                        <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-warning me-2">Editar</a>
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary float-end">Regresar</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mt-3">
                        <div class="accordion mb-3" id="previewAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="previewHeading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#previewCollapse" aria-expanded="false" aria-controls="previewCollapse">
                                        Vista previa del post
                                    </button>
                                </h2>
                                <div id="previewCollapse" class="accordion-collapse collapse" aria-labelledby="previewHeading" data-bs-parent="#previewAccordion">
                                    <div class="accordion-body">
                                        <div class="card mb-4" style="background-image: url('{{ Storage::url($post->featured_image) }}'); background-size: cover; background-position: center;">
                                            <div class="card-body" style="background-color: rgba(255, 255, 255, 0.5);">
                                                <h2 class="card-title">{{ $post->title }}</h2>
                                                <p class="card-text">{!! Str::limit(strip_tags($post->excerpt), 70) !!}</p>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn" style="background-color:  #f18770; color: #ffffff;">Leer más &rarr;</a>
                                                    <div>
                                                        <a href="#" style="color: #1DA1F2; margin-right: 10px;">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                        <a href="#" style="color: #3b5998;">
                                                            <i class="fab fa-facebook"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="card-footer text-muted">
                                                Publicado el {{ $post->created_at->format('d/m/Y') }} por {{ $post->user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <article>
                                    <header class="mb-4">
                                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
    
                                        <div class="text-muted fst-italic mb-2">
                                            Publicado el
                                            @if($post->created_at)
                                                {{ $post->created_at->format('d/m/Y') }}
                                            @else
                                                Unknown date
                                            @endif
                                            por {{ $post->user ? $post->user->name : 'Unknown' }}
                                        </div>
    
                                        @if($post->categoria)
                                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $post->categoria->nombre }}</a>
                                        @else
                                            <span class="badge bg-secondary">Sin categoría</span>
                                        @endif
                                    </header>
    
                                    <div class="mb-4">
                                        
                                        {!! $post->excerpt !!}
                                    </div>
    
                                    <section class="mb-5">
                                        
                                        {!! $post->content !!}
                                    </section>
    
                                    <figure class="mb-4">
                                        @if($post->featured_image)
                                            <img class="img-fluid rounded" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" />
                                        @endif
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <p><strong>Categoría ID:</strong>
                                    @if($post->categoria_id)
                                        {{ $post->categoria->nombre }}
                                    @else
                                        No asignado
                                    @endif
                                </p>
                                <p><strong>Etiquetas:</strong> {{ $post->tags }}</p>
                                <p><strong>Estado:</strong> {{ ucfirst($post->status) }}</p>
                            </div>
                        </div>
                    </div>
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
        CKEDITOR.replace('excerpt', { readOnly: true });
        CKEDITOR.replace('content', { readOnly: true });
    });
</script>
@endpush

