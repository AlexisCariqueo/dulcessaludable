@extends('layouts.blog-plantilla')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Resultados Encontrados</h1>
            @foreach($posts as $post)
            <div class="card mb-4" style="background-image: url('{{ Storage::url($post->featured_image) }}'); background-size: cover; background-position: center;">
                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.5);">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{!! Str::limit($post->excerpt, 70) !!}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="btn" style="background-color:  #f18770; color: #yourcolor;">Leer más &rarr;</a>

                </div>
                <div class="card-footer text-muted">
                    Publicado el {{ $post->created_at->format('d/m/Y') }} por {{ $post->user->name }}
                </div>                    
            </div>
        @endforeach
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <a href="{{ route('tienda.index') }}">
                    <img class="card-img-top" src="{{ asset('storage/blog/irtienda.jpg') }}" alt="Imagen de la tienda">
                </a>                               
                <h5 class="card-header">Posts más vistos</h5>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @foreach($mostViewedPosts as $post)
                            <li>
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                <span class="text-muted">({{ $post->views }} vistas)</span>
                            </li>
                        @endforeach
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
