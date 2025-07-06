@extends('layouts.main')

@section('title', 'Todos os Episódios - PODDEV')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/episodes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

@section('content')
<div class="episodes-container">
    
    {{-- Header da página --}}
    <div class="episodes-header">
        <h1 class="page-title">Todos os Episódios</h1>
        <p class="page-description">
            Explore nossa biblioteca completa de episódios sobre tecnologia, 
            desenvolvimento e carreira.
        </p>
    </div>

    {{-- Busca e Filtros --}}
    <div class="search-filter-section">
        <form method="GET" action="{{ route('episodes.index') }}" class="search-form">
            <div class="search-input-group">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar episódios..." 
                    value="{{ request('search') }}"
                    class="search-input"
                >
                <button type="submit" class="search-btn">
                    <img src="{{ asset('img/search.svg') }}" alt="Buscar">
                </button>
            </div>

            <div class="filters-row">
                {{-- Filtro por categoria --}}
                <select name="category" class="filter-select" onchange="this.form.submit()">
                    <option value="">Todas as categorias</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" 
                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->episodes_count }})
                        </option>
                    @endforeach
                </select>

                {{-- Filtro por tag --}}
                <select name="tag" class="filter-select" onchange="this.form.submit()">
                    <option value="">Todas as tags</option>
                    @foreach($popularTags as $tag)
                        <option value="{{ $tag->slug }}" 
                                {{ request('tag') == $tag->slug ? 'selected' : '' }}>
                            {{ $tag->name }} ({{ $tag->episodes_count }})
                        </option>
                    @endforeach
                </select>

                {{-- Limpar filtros --}}
                @if(request()->hasAny(['search', 'category', 'tag']))
                    <a href="{{ route('episodes.index') }}" class="clear-filters">
                        Limpar filtros
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Informações dos resultados --}}
    @if(request()->hasAny(['search', 'category', 'tag']))
        <div class="search-results-info">
            <p>
                @if($episodes->total() > 0)
                    Encontrados <strong>{{ $episodes->total() }}</strong> episódios
                    @if(request('search'))
                        para "<strong>{{ request('search') }}</strong>"
                    @endif
                    @if(request('category'))
                        na categoria <strong>{{ $categories->where('slug', request('category'))->first()->name ?? 'Categoria' }}</strong>
                    @endif
                    @if(request('tag'))
                        com a tag <strong>{{ $popularTags->where('slug', request('tag'))->first()->name ?? 'Tag' }}</strong>
                    @endif
                @else
                    Nenhum episódio encontrado com os filtros aplicados
                @endif
            </p>
        </div>
    @endif

    {{-- Grid principal: episódios + sidebar --}}
    <div class="episodes-main-content">
        {{-- Lista de episódios --}}
        <main class="episodes-content">
            @if($episodes->count() > 0)
                <div class="episodes-grid">
                    @foreach($episodes as $episode)
                        @include('components.episode-card', ['episode' => $episode])
                    @endforeach
                </div>

                {{-- Paginação --}}
                <div class="pagination-wrapper">
                    {{ $episodes->appends(request()->query())->links() }}
                </div>
            @else
                {{-- Estado vazio --}}
                <div class="empty-state">
                    <div class="empty-icon">🎧</div>
                    <h3>Nenhum episódio encontrado</h3>
                    @if(request()->hasAny(['search', 'category', 'tag']))
                        <p>Tente ajustar os filtros de busca ou explorar outras categorias.</p>
                        <a href="{{ route('episodes.index') }}" class="btn-primary">
                            Ver todos os episódios
                        </a>
                    @else
                        <p>Ainda não temos episódios publicados.</p>
                        <a href="{{ route('home') }}" class="btn-primary">
                            Voltar ao início
                        </a>
                    @endif
                </div>
            @endif
        </main>

        {{-- Sidebar --}}
        <aside class="episodes-sidebar">
            <div class="sidebar-content">
                
                {{-- Categorias --}}
                <div class="sidebar-section categories-section">
                    <h4 class="sidebar-title">
                        📂 Categorias
                    </h4>
                    <div class="categories-list">
                        @foreach($categories as $category)
                            <a href="{{ route('episodes.category', $category->slug) }}" 
                               class="category-link {{ request('category') == $category->slug ? 'active' : '' }}">
                                <span class="category-color"></span>
                                <span class="category-name">{{ $category->name }}</span>
                                <span class="category-count">{{ $category->episodes_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Tags populares --}}
                <div class="sidebar-section popular-tags">
                    <h4 class="sidebar-title">
                        🏷️ Tags Populares
                    </h4>
                    @include('components.tag-list', ['tags' => $popularTags, 'showCount' => true])
                </div>

                {{-- Episódios mais populares --}}
                @php
                    $popularEpisodes = \App\Models\Episode::published()
                        ->orderBy('views_count', 'desc')
                        ->take(5)
                        ->get();
                @endphp

                @if($popularEpisodes->count() > 0)
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">
                            🔥 Mais Populares
                        </h4>
                        <div class="popular-episodes">
                            @foreach($popularEpisodes as $index => $episode)
                                <div class="popular-episode-item">
                                    <div class="episode-rank">{{ $index + 1 }}</div>
                                    <div class="episode-info">
                                        <a href="{{ route('episodes.show', $episode->slug) }}" class="episode-link">
                                            {{ Str::limit($episode->title, 60) }}
                                        </a>
                                        <div class="episode-stats">
                                            👀 {{ $episode->views_count }} • ❤️ {{ $episode->likes_count }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Links úteis --}}
                <div class="sidebar-section">
                    <h4 class="sidebar-title">
                        🔗 Links Úteis
                    </h4>
                    <div class="useful-links">
                        <a href="{{ route('about') }}" class="useful-link">
                            Sobre o PODDEV
                        </a>
                        <a href="{{ route('contact') }}" class="useful-link">
                            Entre em contato
                        </a>
                        <a href="https://open.spotify.com/" target="_blank" class="useful-link">
                            Ouvir no Spotify
                        </a>
                        <a href="https://www.youtube.com/" target="_blank" class="useful-link">
                            Canal no YouTube
                        </a>
                    </div>
                </div>

                {{-- Estatísticas --}}
                <div class="sidebar-section">
                    <h4 class="sidebar-title">
                        📊 Estatísticas
                    </h4>
                    <div class="stats-list">
                        <div class="stat-item">
                            <strong>{{ \App\Models\Episode::published()->count() }}</strong>
                            <span>Episódios</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ \App\Models\Category::active()->count() }}</strong>
                            <span>Categorias</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ \App\Models\Tag::count() }}</strong>
                            <span>Tags</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ \App\Models\Episode::published()->sum('views_count') }}</strong>
                            <span>Visualizações</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<style>
/* Estilos específicos para a grid de stats na sidebar */
.stats-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    text-align: center;
}

.stats-list .stat-item {
    background: #f9fafb;
    padding: 12px 8px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.stats-list .stat-item strong {
    display: block;
    color: #2d3250;
    font-size: 1.1rem;
    margin-bottom: 4px;
}

.stats-list .stat-item span {
    color: #6b7280;
    font-size: 11px;
}

/* Melhorias na responsividade */
@media (max-width: 768px) {
    .episodes-container {
        padding: 20px 15px;
    }
    
    .stats-list {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .filters-row {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-select {
        width: 100%;
    }
}
</style>
@endsection