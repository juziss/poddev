@extends('layouts.main')

@section('title', 'Episódios com a tag ' . $tag->name . ' - PODDEV')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/episodes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/by-tag.css') }}">
@endpush

@section('content')
<div class="episodes-container">
    
    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">></span>
        <a href="{{ route('episodes.index') }}">Episódios</a>
        <span class="separator">></span>
        <span class="current">Tag: {{ $tag->name }}</span>
    </nav>

    {{-- Header da tag --}}
    <div class="tag-header">
        <div class="tag-badge-large">
            🏷️ {{ $tag->name }}
        </div>
        <h1 class="tag-title">
            Episódios com a tag "{{ $tag->name }}"
        </h1>
        
        <p class="tag-description">
            Explore todos os episódios relacionados ao tema <strong>{{ $tag->name }}</strong>
        </p>

        <div class="tag-stats">
            <span class="stat-item">
                📺 {{ $episodes->total() }} episódios
            </span>
            <span class="stat-item">
                🏷️ Tag {{ $tag->name }}
            </span>
        </div>
    </div>

    {{-- Barra de busca específica da tag --}}
    <div class="search-filter-section">
        <form method="GET" action="{{ route('episodes.tag', $tag->slug) }}" class="search-form">
            <div class="search-input-group">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar episódios com {{ $tag->name }}..." 
                    value="{{ request('search') }}"
                    class="search-input"
                >
                <button type="submit" class="search-btn">
                    <img src="{{ asset('img/search.svg') }}" alt="Buscar">
                </button>
            </div>

            @if(request('search'))
                <div class="active-filters">
                    <span class="filter-label">Filtrando por:</span>
                    <span class="filter-tag">
                        "{{ request('search') }}"
                        <a href="{{ route('episodes.tag', $tag->slug) }}" class="remove-filter">×</a>
                    </span>
                </div>
            @endif
        </form>
    </div>

    {{-- Resultados da busca --}}
    @if(request('search'))
        <div class="search-results-info">
            <p>
                @if($episodes->total() > 0)
                    Encontrados <strong>{{ $episodes->total() }}</strong> episódios com 
                    <strong>{{ $tag->name }}</strong> para 
                    "<strong>{{ request('search') }}</strong>"
                @else
                    Nenhum episódio com <strong>{{ $tag->name }}</strong> encontrado para 
                    "<strong>{{ request('search') }}</strong>"
                @endif
            </p>
        </div>
    @endif

    {{-- Grid principal --}}
    <div class="episodes-main-content">
        {{-- Lista de episódios --}}
        <div class="episodes-content">
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
                    <div class="empty-icon">🏷️</div>
                    <h3>Nenhum episódio encontrado</h3>
                    @if(request('search'))
                        <p>Não encontramos episódios com <strong>{{ $tag->name }}</strong> 
                           e o termo "<strong>{{ request('search') }}</strong>".</p>
                        <a href="{{ route('episodes.tag', $tag->slug) }}" class="btn-primary">
                            Ver todos os episódios com {{ $tag->name }}
                        </a>
                    @else
                        <p>Ainda não temos episódios com esta tag.</p>
                        <a href="{{ route('episodes.index') }}" class="btn-primary">
                            Explorar outros episódios
                        </a>
                    @endif
                </div>
            @endif
        </div>

        {{-- Sidebar com informações da tag --}}
        <aside class="tag-sidebar">
            {{-- Informações da tag --}}
            <div class="sidebar-section tag-info">
                <h4>🏷️ Sobre a tag {{ $tag->name }}</h4>
                
                <div class="tag-meta">
                    <div class="meta-item">
                        <strong>{{ $episodes->total() }}</strong>
                        <span>Episódios</span>
                    </div>
                    <div class="meta-item">
                        <strong>{{ $episodes->sum('views_count') }}</strong>
                        <span>Visualizações</span>
                    </div>
                </div>

                {{-- Categorias que usam esta tag --}}
                @php
                    $categoriesWithTag = \App\Models\Category::whereHas('episodes.tags', function($q) use ($tag) {
                        $q->where('tags.id', $tag->id);
                    })
                    ->withCount(['episodes' => function($q) use ($tag) {
                        $q->whereHas('tags', function($q) use ($tag) {
                            $q->where('tags.id', $tag->id);
                        })->where('status', 'published');
                    }])
                    ->having('episodes_count', '>', 0)
                    ->orderBy('episodes_count', 'desc')
                    ->get();
                @endphp

                @if($categoriesWithTag->count() > 0)
                    <div class="tag-categories">
                        <h5>📂 Categorias relacionadas:</h5>
                        <div class="categories-list">
                            @foreach($categoriesWithTag as $category)
                                <a href="{{ route('episodes.category', $category->slug) }}" 
                                   class="category-link">
                                    <span class="category-color"></span>
                                    <span class="category-name">{{ $category->name }}</span>
                                    <span class="category-count">({{ $category->episodes_count }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Tags relacionadas --}}
            @php
                $relatedTags = \App\Models\Tag::where('id', '!=', $tag->id)
                    ->whereHas('episodes.tags', function($q) use ($tag) {
                        $q->where('tags.id', $tag->id);
                    })
                    ->withCount(['episodes' => function($q) {
                        $q->where('status', 'published');
                    }])
                    ->orderBy('episodes_count', 'desc')
                    ->take(8)
                    ->get();
            @endphp

            @if($relatedTags->count() > 0)
                <div class="sidebar-section related-tags">
                    <h4>🔗 Tags Relacionadas</h4>
                    <p class="related-tags-description">
                        Outras tags que aparecem junto com <strong>{{ $tag->name }}</strong>
                    </p>
                    @include('components.tag-list', ['tags' => $relatedTags, 'showCount' => true])
                </div>
            @endif

            {{-- Todas as tags --}}
            <div class="sidebar-section all-tags">
                <h4>🏷️ Explorar Tags</h4>
                @php
                    $allTags = \App\Models\Tag::withCount(['episodes' => function($q) {
                        $q->where('status', 'published');
                    }])
                    ->having('episodes_count', '>', 0)
                    ->orderBy('episodes_count', 'desc')
                    ->take(12)
                    ->get();
                @endphp
                
                @include('components.tag-list', ['tags' => $allTags, 'showCount' => true])
                
                <div class="view-all-tags">
                    <a href="{{ route('episodes.index') }}" class="btn-secondary">
                        Ver todos os episódios
                    </a>
                </div>
            </div>
        </aside>
    </div>
</div>

<style>
.tag-header {
    grid-column: 1 / -1;
    text-align: center;
    margin: 30px 0 40px;
}

.tag-badge-large {
    display: inline-block;
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
}

.tag-title {
    font-size: 2.5rem;
    color: #2d3250;
    margin-bottom: 15px;
}

.tag-description {
    color: #6b7280;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto 20px;
}

.tag-stats {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.tag-stats .stat-item {
    color: #9ca3af;
    font-size: 14px;
}

.tag-sidebar {
    display: flex;
    flex-direction: column;
    gap: 25px;
    position: sticky;
    top: 120px;
}

.tag-meta {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    text-align: center;
    margin-bottom: 20px;
}

.tag-meta .meta-item strong {
    display: block;
    color: #2d3250;
    font-size: 1.2rem;
}

.tag-meta .meta-item span {
    color: #9ca3af;
    font-size: 12px;
}

.tag-categories h5 {
    color: #2d3250;
    font-size: 14px;
    margin-bottom: 10px;
}

.related-tags-description {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 15px;
    line-height: 1.4;
}

.view-all-tags {
    margin-top: 15px;
    text-align: center;
}

.btn-secondary {
    background: #f3f4f6;
    color: #4b5563;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #e5e7eb;
    color: #2d3250;
}

@media (max-width: 768px) {
    .episodes-main-content {
        grid-template-columns: 1fr;
    }
    
    .tag-sidebar {
        position: static;
    }
    
    .tag-title {
        font-size: 2rem;
    }
    
    .tag-meta {
        grid-template-columns: 1fr;
        text-align: center;
    }
}
</style>
@endsection