@extends('layouts.blog-plantilla')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Blog</h1>
            @foreach($posts as $post)
            <div class="card mb-4" style="background-image: url('{{ Storage::url($post->featured_image) }}'); background-size: cover; background-position: center;">
                <div class="card-body" style="background-color: rgba(255, 255, 255, 0.5);">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    @if($post->categoria)
                    <a class="badge text-decoration-none link-light" style="background-color:  #11a104; color: #ffffff;" href="#!">{{ $post->categoria->nombre }}</a>
                    @else
                        <span class="badge bg-secondary">Sin categoría</span>
                    @endif
                    @if($post->tags)
                        @foreach(json_decode($post->tags) as $tag)
                            <span class="badge" style="background-color:  #f18770; color: #ffffff;" >{{ $tag }}</span>
                        @endforeach
                    @endif
                    <p class="card-text">{!! Str::limit(strip_tags($post->excerpt), 70) !!}</p>
                    <div style="display: flex; justify-content: space-between;">
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn" style="background-color:  #f18770; color: #ffffff;">Leer más &rarr;</a>
                        <div>
                            <a href="https://twitter.com/share?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank" style="color: #1DA1F2; margin-right: 10px;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank" style="color: #3b5998;">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </div>
                    </div>
                </div>                                                       
                <div class="card-footer text-muted">
                    Publicado el {{ $post->created_at->format('d/m/Y') }} por {{ $post->user->name }}
                </div>                    
            </div>
            @endforeach
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <a href="{{ route('tienda.index') }}">
                    <img class="card-img-top" src="{{ asset('/storage/storage/blog/irtienda.jpg') }}" alt="Imagen de la tienda">
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
<style>
    .black-text {
        color: black;
    }
    .pagination .page-link {
        color: rgb(0, 0, 0);
        border: none; 
    }

    .pagination .page-item.active .page-link {
        background-color: #b36b50;
        border: none; 
    }
</style>
