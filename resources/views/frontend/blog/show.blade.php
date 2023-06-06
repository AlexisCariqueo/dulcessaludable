@extends('layouts.blog-plantilla')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>

                    <div class="text-muted fst-italic mb-2">
                        Posted on
                        @if($post->created_at)
                            {{ $post->created_at->format('d/m/Y') }}
                        @else
                            Unknown date
                        @endif
                        by {{ $post->user ? $post->user->name : 'Unknown' }}
                    </div>

                    @if($post->categoria)
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $post->categoria->nombre }}</a>
                    @else
                        <span class="badge bg-secondary">Sin categoría</span>
                    @endif
                </header>

                <!-- Excerpt -->
                <div class="mb-4">
                    {!! $post->excerpt !!}
                </div>

                <section class="mb-5">
                    {!! $post->content !!}
                </section>

                <!-- Featured Image -->
                <figure class="mb-4">
                    <img class="img-fluid rounded" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" />
                </figure>

                                
            </article>
        </div>
        <div class="col-md-4">
            <div class="card my-4">
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
