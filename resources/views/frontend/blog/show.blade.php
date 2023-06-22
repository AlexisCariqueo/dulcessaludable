@extends('layouts.blog-plantilla')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body">
                    <article>
                        <header class="mb-4 d-flex justify-content-between align-items-center">
                            <div>
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
                                @if($post->tags)
                                    @foreach(json_decode($post->tags) as $tag)
                                        <span class="badge bg-primary">{{ $tag }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div>
                                <a href="https://twitter.com/share?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank" style="color: #1DA1F2; margin-right: 20px; font-size: 2rem;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank" style="color: #3b5998; font-size: 2rem;">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </div>
                        </header>
                        <div class="mb-4">
                            {!! $post->excerpt !!}
                        </div>
                        <section class="mb-5">
                            {!! $post->content !!}
                        </section>
                        <figure class="mb-4">
                            <img class="img-fluid rounded" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" />
                        </figure>                            
                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <a href="{{ route('tienda.index') }}">
                    <img class="card-img-top" src="{{ asset('storage/storage/blog/irtienda.jpg') }}" alt="Imagen de la tienda">
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
