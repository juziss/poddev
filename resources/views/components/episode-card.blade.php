{{-- 
    Componente reutilizável para exibir um card de episódio
    Usage: @include('components.episode-card', ['episode' => $episode])
--}}

<article class="episode-card">
    {{-- Categoria do episódio --}}
    @if($episode->category)
        <div class="episode-card-category">
            <a href="{{ route('episodes.category', $episode->category->slug) }}" 
               class="category-badge category-{{ $episode->category->id }}">
                {{ $episode->category->name }}
            </a>
        </div>
    @endif

    {{-- Título do episódio --}}
    <h3 class="episode-card-title">
        <a href="{{ route('episodes.show', $episode->slug) }}">
            {{ $episode->title }}
        </a>
    </h3>

    {{-- Descrição resumida --}}
    <p class="episode-card-description">
        {{ Str::limit($episode->description, 120) }}
    </p>

    {{-- Meta informações --}}
    <div class="episode-card-meta">
        <div class="meta-left">
            @if($episode->duration_formatted)
                <span class="meta-duration">⏱️ {{ $episode->duration_formatted }}</span>
            @endif
            
            @if($episode->published_at)
                <span class="meta-date">📅 {{ $episode->published_at->format('d/m/Y') }}</span>
            @endif
        </div>
        
        <div class="meta-right">
            @if($episode->views_count > 0)
                <span class="meta-views">👀 {{ $episode->views_count }}</span>
            @endif
            
            @if($episode->likes_count > 0)
                <span class="meta-likes">❤️ {{ $episode->likes_count }}</span>
            @endif
        </div>
    </div>

    {{-- Tags do episódio --}}
    @if($episode->tags->count() > 0)
        <div class="episode-card-tags">
            @foreach($episode->tags->take(3) as $tag)
                <a href="{{ route('episodes.tag', $tag->slug) }}" class="tag-item">
                    {{ $tag->name }}
                </a>
            @endforeach
            
            @if($episode->tags->count() > 3)
                <span class="tag-item tag-more">
                    +{{ $episode->tags->count() - 3 }}
                </span>
            @endif
        </div>
    @endif

    {{-- Indicador de episódio em destaque --}}
    @if($episode->featured)
        <div class="featured-indicator">
            <span class="featured-badge">⭐ Destaque</span>
        </div>
    @endif
</article>