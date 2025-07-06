{{-- 
    Componente para exibir lista de tags
    Usage: @include('components.tag-list', ['tags' => $tags])
--}}

<div class="tag-list">
    @forelse($tags as $tag)
        <a href="{{ route('episodes.tag', $tag->slug) }}" 
           class="tag-link"
           style="--tag-color: {{ $tag->color }}">
            <span class="tag-name">{{ $tag->name }}</span>
            @if(isset($showCount) && $showCount)
                <span class="tag-count">({{ $tag->episodes_count ?? 0 }})</span>
            @endif
        </a>
    @empty
        <p class="no-tags">Nenhuma tag encontrada.</p>
    @endforelse
</div>

<style>
.tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.tag-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: var(--tag-color, #f3f4f6);
    color: white;
    padding: 6px 12px;
    border-radius: 16px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.tag-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.tag-link:hover::before {
    opacity: 1;
}

.tag-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.tag-name {
    position: relative;
    z-index: 1;
}

.tag-count {
    position: relative;
    z-index: 1;
    opacity: 0.8;
    font-size: 11px;
}

.no-tags {
    color: #9ca3af;
    font-style: italic;
    font-size: 14px;
}

/* Variação para tags pequenas */
.tag-list.small .tag-link {
    padding: 4px 8px;
    font-size: 11px;
    border-radius: 12px;
}

/* Variação para tags em linha */
.tag-list.inline {
    display: inline-flex;
}
</style>