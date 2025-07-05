@extends('layouts.main')

@section('title', 'PODDEV - Podcasts para Desenvolvedores')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

@section('content')
<div class="home-container">
    
    {{-- Banner --}}
    <section class="banner-section">
    <p>esse é o</p>
    <h1>PODDEV</h1>
    <p>Uma mesa. Várias ideias. </p>
    <div>
        <p>Disponível em</p>
        <a href="https://open.spotify.com/"><img src="{{ asset('img/spotify.svg') }}" alt="Ícone Spotify"></a>
        <a href="https://www.youtube.com/"><img src="{{ asset('img/youtube.svg') }}" alt="Ícone Youtube"></a>
        <a href="https://podcasts.apple.com/br/browse"><img src="{{ asset('img/applepodcasts.svg') }}" alt="Ícone Apple Podcasts"></a>
    </div>
    </section>
    
    {{-- Episódio em Destaque --}}
    @if($featuredEpisode)
    <section class="featured-section">
        <h2 class="featured-title">Episódio em Destaque</h2>
        <div class="featured-card">
            <div class="featured-content">
                <div class="featured-text">
                    <span class="featured-category category-{{ $featuredEpisode->category->id }}">
                        {{ $featuredEpisode->category->name }}
                    </span>
                    <h3 class="featured-episode-title">
                        {{ $featuredEpisode->title }}
                    </h3>
                    <p class="featured-description">
                        {{ $featuredEpisode->description }}
                    </p>
                    <div class="featured-meta">
                        <span class="meta-item">⏱️ {{ $featuredEpisode->duration_formatted ?? '45min' }}</span>
                        <span class="meta-item">👀 {{ $featuredEpisode->views_count }} views</span>
                        <span class="meta-item">❤️ {{ $featuredEpisode->likes_count }} likes</span>
                    </div>
                    <a href="{{ route('episodes.show', $featuredEpisode->slug) }}" class="featured-button">
                        Ouvir Episódio
                    </a>
                </div>
                @if($featuredEpisode->thumbnail)
                <div class="featured-thumbnail">
                    <img src="{{ $featuredEpisode->thumbnail }}" alt="Thumbnail do {{ $featuredEpisode->title }}">
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Últimos Episódios --}}
    <section class="latest-section">
        <h2 class="section-title">Últimos Episódios</h2>
        <div class="episodes-grid">
            @foreach($latestEpisodes as $episode)
            <article class="episode-card">
                <div class="episode-category">
                    <a href="{{ route('episodes.category', $episode->category->slug) }}" 
                       class="category-badge category-{{ $episode->category->id }}">
                        {{ $episode->category->name }}
                    </a>
                </div>
                <h3 class="episode-title">
                    <a href="{{ route('episodes.show', $episode->slug) }}">
                        {{ $episode->title }}
                    </a>
                </h3>
                <p class="episode-description">
                    {{ Str::limit($episode->description, 120) }}
                </p>
                <div class="episode-meta">
                    <span class="meta-duration">{{ $episode->duration_formatted ?? '30min' }}</span>
                    <span class="meta-date">{{ $episode->published_at->format('d/m/Y') }}</span>
                </div>
                
                {{-- Tags do episódio --}}
                @if($episode->tags->count() > 0)
                <div class="episode-tags">
                    @foreach($episode->tags->take(3) as $tag)
                    <span class="tag-item">
                        {{ $tag->name }}
                    </span>
                    @endforeach
                </div>
                @endif
            </article>
            @endforeach
        </div>
        
        <div class="view-all-section">
            <a href="{{ route('episodes.index') }}" class="btn-primary">
                Ver Todos os Episódios
            </a>
        </div>
    </section>

    {{-- Categorias --}}
    <section class="categories-section">
        <h2 class="section-title">Categorias</h2>
        <div class="categories-grid">
            @foreach($categories as $category)
            <a href="{{ route('episodes.category', $category->slug) }}" 
               class="category-item category-{{ $category->id }}">
                <h3 class="category-name">{{ $category->name }}</h3>
                <p class="category-description">{{ $category->description }}</p>
                <span class="category-count">{{ $category->episodes_count }} episódios</span>
            </a>
            @endforeach
        </div>
    </section>

</div>
@endsection