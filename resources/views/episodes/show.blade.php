@extends('layouts.main')

@section('title', $episode->meta_title ?: $episode->title . ' - PODDEV')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/episode-show.css') }}">
@endpush

@section('content')
<div class="episode-show-container">
    
    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">›</span>
        <a href="{{ route('episodes.index') }}">Episódios</a>
        @if($episode->category)
            <span class="separator">›</span>
            <a href="{{ route('episodes.category', $episode->category->slug) }}">
                {{ $episode->category->name }}
            </a>
        @endif
        <span class="separator">›</span>
        <span class="current">{{ $episode->title }}</span>
    </nav>

    {{-- Conteúdo principal --}}
    <main class="episode-main">
        
        {{-- Header do episódio --}}
        <header class="episode-header">
            {{-- Categoria --}}
            @if($episode->category)
                <div class="episode-category">
                    <a href="{{ route('episodes.category', $episode->category->slug) }}" 
                       class="category-badge category-{{ $episode->category->id }}">
                        {{ $episode->category->name }}
                    </a>
                </div>
            @endif

            {{-- Título --}}
            <h1 class="episode-title">{{ $episode->title }}</h1>

            {{-- Metadados --}}
            <div class="episode-meta">
                <div class="meta-row">
                    @if($episode->episode_number)
                        <span class="meta-item">
                            <strong>Episódio #{{ $episode->episode_number }}</strong>
                        </span>
                    @endif
                    
                    @if($episode->published_at)
                        <span class="meta-item">
                            📅 {{ $episode->published_at->format('d/m/Y') }}
                        </span>
                    @endif
                    
                    @if($episode->duration_formatted)
                        <span class="meta-item">
                            ⏱️ {{ $episode->duration_formatted }}
                        </span>
                    @endif
                </div>

                <div class="stats-row">
                    <span class="stat-item">👀 {{ $episode->views_count }} visualizações</span>
                    <span class="stat-item">❤️ {{ $episode->likes_count }} curtidas</span>
                    @if($episode->downloads_count > 0)
                        <span class="stat-item">⬇️ {{ $episode->downloads_count }} downloads</span>
                    @endif
                </div>
            </div>

            {{-- Descrição --}}
            <div class="episode-description">
                <p>{{ $episode->description }}</p>
            </div>

            {{-- Player de áudio ou links --}}
            <div class="episode-player">
                @if($episode->audio_file)
                    <audio controls class="audio-player">
                        <source src="{{ asset('storage/' . $episode->audio_file) }}" type="audio/mpeg">
                        Seu navegador não suporta o elemento de áudio.
                    </audio>
                @endif

                {{-- Links para plataformas --}}
                <div class="platform-links">
                    <h4>Ouça também em:</h4>
                    <div class="platform-buttons">
                        @if($episode->audio_url)
                            <a href="{{ $episode->audio_url }}" target="_blank" class="platform-btn spotify">
                                <img src="{{ asset('img/spotify.svg') }}" alt="Spotify">
                                Spotify
                            </a>
                        @endif
                        
                        <a href="https://www.youtube.com/" target="_blank" class="platform-btn youtube">
                            <img src="{{ asset('img/youtube.svg') }}" alt="YouTube">
                            YouTube
                        </a>
                        
                        <a href="https://podcasts.apple.com/" target="_blank" class="platform-btn apple">
                            <img src="{{ asset('img/applepodcasts.svg') }}" alt="Apple Podcasts">
                            Apple Podcasts
                        </a>
                    </div>
                </div>
            </div>
        </header>

        {{-- Tags --}}
        @if($episode->tags->count() > 0)
            <section class="episode-tags-section">
                <h3>Tags</h3>
                @include('components.tag-list', ['tags' => $episode->tags])
            </section>
        @endif

        {{-- Conteúdo/Show Notes --}}
        @if($episode->content)
            <section class="episode-content">
                <h3>Show Notes</h3>
                <div class="content-body">
                    {!! nl2br(e($episode->content)) !!}
                </div>
            </section>
        @endif

        {{-- Episódios relacionados --}}
        @if($relatedEpisodes->count() > 0)
            <section class="related-episodes">
                <h3>Episódios Relacionados</h3>
                <div class="related-grid">
                    @foreach($relatedEpisodes as $relatedEpisode)
                        @include('components.episode-card', ['episode' => $relatedEpisode])
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    {{-- Sidebar --}}
    <aside class="episode-sidebar">
        {{-- Informações do autor --}}
        <div class="author-info">
            <h4>Apresentado por</h4>
            <div class="author-card">
                <div class="author-name">{{ $episode->user->name }}</div>
                <div class="author-role">Host do PODDEV</div>
            </div>
        </div>

            {{-- Próximo episódio --}}
            @if($nextEpisode = App\Models\Episode::published()
                ->where('published_at', '>', $episode->published_at)
                ->oldest('published_at')
                ->first())
                <a href="{{ route('episodes.show', $nextEpisode->slug) }}" class="nav-episode next">
                    <span class="nav-label">Próximo Episódio →</span>
                    <span class="nav-title">{{ Str::limit($nextEpisode->title, 40) }}</span>
                </a>
            @endif
        </div>

    </aside>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Link copiado para a área de transferência!');
        });
    }
</script>
@endsection