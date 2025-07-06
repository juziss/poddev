@extends('layouts.main')

@section('title', 'Episódios de ' . $category->name . ' - PODDEV')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/episodes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/by-category.css') }}">
@endpush

@section('content')
<div class="episodes-container">
    
    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">›</span>
        <a href="{{ route('episodes.index') }}">Episódios</a>
        <span class="separator">›</span>
        <span class="current">{{ $category->name }}</span>
    </nav>

    {{-- Header da categoria --}}
    <div class="category-header">
        <div class="category-badge-large category-{{ $category->id }}">
            {{ $category->name }}
        </div>
        <h1 class="category-title">
            Episódios de {{ $category->name }}
        </h1>
        
        @if($category->description)
            <p class="category-description">
                {{ $category->description }}
            </p>
        @endif

        <div class="category-stats">
            <span class="stat-item">
                📺 {{ $episodes->total() }} episódios
            </span>
            <span class="stat-item">
                🎯 Categoria {{ $category->name }}
            </span>
        </div>
    </div>

    {{-- Barra de busca específica da categoria --}}
    <div class="search-filter-section">
        <form method="GET" action="{{ route('episodes.category', $category->slug) }}" class="search-form">
            <div class="search-input-group">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar em {{ $category->name }}..." 
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
                        <a href="{{ route('episodes.category', $category->slug) }}" class="remove-filter">×</a>
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
                    Encontrados <strong>{{ $episodes->total() }}</strong> episódios de 
                    <strong>{{ $category->name }}</strong> para 
                    "<strong>{{ request('search') }}</strong>"
                @else
                    Nenhum episódio de <strong>{{ $category->name }}</strong> encontrado para 
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
                    <div class="empty-icon">📻</div>
                    <h3>Nenhum episódio encontrado</h3>
                    @if(request('search'))
                        <p>Não encontramos episódios de <strong>{{ $category->name }}</strong> 
                           com o termo "<strong>{{ request('search') }}</strong>".</p>
                        <a href="{{ route('episodes.category', $category->slug) }}" class="btn-primary">
                            Ver todos os episódios de {{ $category->name }}
                        </a>
                    @else
                        <p>Ainda não temos episódios nesta categoria.</p>
                        <a href="{{ route('episodes.index') }}" class="btn-primary">
                            Explorar outros episódios
                        </a>
                    @endif
                </div>
            @endif
        </div>

        {{-- Sidebar com informações da categoria --}}
        <aside class="category-sidebar">
            {{-- Informações da categoria --}}
            <div class="sidebar-section category-info">
                <h4>📂 Sobre {{ $category->name }}</h4>
                @if($category->description)
                    <p class="category-full-description">
                        {{ $category->description }}
                    </p>
                @endif
                
                <div class="category-meta">
                    <div class="meta-item">
                        <strong>{{ $episodes->total() }}</strong>
                        <span>Episódios</span>
                    </div>
                    <div class="meta-item">
                        <strong>{{ \App\Models\Episode::where('category_id', $category->id)->sum('views_count') }}</strong>
                        <span>Visualizações</span>
                    </div>
                </div>
            </div>

            {{-- Outras categorias --}}
            <div class="sidebar-section other-categories">
                <h4>🗂️ Outras Categorias</h4>
                <div class="categories-list">
                    @php
                        $otherCategories = \App\Models\Category::active()
                            ->where('id', '!=', $category->id)
                            ->withCount(['episodes' => function($q) {
                                $q->where('status', 'published');
                            }])
                            ->orderBy('episodes_count', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @foreach($otherCategories as $otherCategory)
                        <a href="{{ route('episodes.category', $otherCategory->slug) }}" 
                           class="category-link">
                            <span class="category-color"></span>
                            <span class="category-name">{{ $otherCategory->name }}</span>
                            <span class="category-count">({{ $otherCategory->episodes_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Tags relacionadas --}}
            @php
                $relatedTags = \App\Models\Tag::whereHas('episodes', function($q) use ($category) {
                    $q->where('category_id', $category->id)->where('status', 'published');
                })
                ->withCount(['episodes' => function($q) use ($category) {
                    $q->where('category_id', $category->id)->where('status', 'published');
                }])
                ->orderBy('episodes_count', 'desc')
                ->take(8)
                ->get();
            @endphp

            @if($relatedTags->count() > 0)
                <div class="sidebar-section related-tags">
                    <h4>🏷️ Tags em {{ $category->name }}</h4>
                    @include('components.tag-list', ['tags' => $relatedTags, 'showCount' => true])
                </div>
            @endif
        </aside>
    </div>
</div>

<style>
.category-header {
    grid-column: 1 / -1;
    text-align: center;
    margin: 30px 0 40px;
}

.category-badge-large {
    display: inline-block;
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
}

.category-title {
    font-size: 2.5rem;
    color: #2d3250;
    margin-bottom: 15px;
}

.category-description {
    color: #6b7280;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto 20px;
}

.category-stats {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.category-stats .stat-item {
    color: #9ca3af;
    font-size: 14px;
}

.episodes-main-content {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 40px;
    align-items: start;
}

.active-filters {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-label {
    font-size: 14px;
    color: #6b7280;
}

.filter-tag {
    background: #f3f4f6;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    color: #4b5563;
    display: flex;
    align-items: center;
    gap: 4px;
}

.remove-filter {
    color: #ef4444;
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
}

.category-sidebar {
    display: flex;
    flex-direction: column;
    gap: 25px;
    position: sticky;
    top: 120px;
}

.category-info .category-full-description {
    color: #6b7280;
    line-height: 1.5;
    margin-bottom: 15px;
}

.category-meta {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    text-align: center;
}

.category-meta .meta-item strong {
    display: block;
    color: #2d3250;
    font-size: 1.2rem;
}

.category-meta .meta-item span {
    color: #9ca3af;
    font-size: 12px;
}

@media (max-width: 768px) {
    .episodes-main-content {
        grid-template-columns: 1fr;
    }
    
    .category-sidebar {
        position: static;
    }
    
    .category-title {
        font-size: 2rem;
    }
}
</style>
@endsection