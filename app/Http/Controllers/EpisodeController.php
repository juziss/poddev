<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Category;
use App\Models\Tag;

class EpisodeController extends Controller
{
    //exibe lista de eps com filtro e busca
    //metodo será chamado quando alguém acessar /episodes
    public function index(Request $request)
    {
        //inicia a query dos eps publicados
        $query = Episode::published()
                        ->with(['category', 'tags', 'user'])
                        ->latest(); //ordena por + recente
        
        //filtro por busca (se o usuário digitou algo)
        if ($request->filled('search')){
            $search = $request->get('search');
            $query->where(function($q) use ($search){
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}")
                  ->orWhere('content', 'like', "%{$search}");
            });
        }

        //filtro por categoria
        if ($request->filled('category')){
            $query->byCategory($request->get('category'));
        }

        // Filtro por tag
        if ($request->filled('tag')){
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->get('tag'));
            });
        }

        //paginação (com 13 eps por pag)
        $episodes = $query->paginate(12);

        //busca dados extras p sidebar/filtros
        $categories = Category::active()
                            ->withCount(['episodes' => function($q) {
                                $q->where('status', 'published');
                            }])
                            ->get();

        $popularTags = Tag::withCount(['episodes' => function($q){
            $q->where('status', 'published');
        }])
        ->orderBy('episodes_count', 'desc')
        ->limit('10')
        ->get();

        return view('episodes.index', compact(
            'episodes',
            'categories',
            'popularTags'
        ));
    }

    //busca o ep pelo slug
    public function show(Episode $episode)
    {
        //verifica se o episódio está publicado (segurança)
        if (!$episode->isPublished()){
            abort(404, 'Episódio não encontado ou não publicado.');
        }

        //incrementa visualizações
        $episode->incrementViews();

        //carrega relacionamentos
        $episode->load(['category', 'tags', 'user']);

        //busca eps relacionados (msm categoria, menos a atual)
        $relatedEpisodes = Episode::published()
                                    ->where('category_id', $episode->category_id)
                                    ->where('id', '!=', $episode->id)
                                    ->latest()
                                    ->limit(4)
                                    ->get();
        
        return view('episodes.show', compact('episode', 'relatedEpisodes'));
    }

    //PAGINA INICIAL -> eps em destaque
    public function home()
    {
        //ep principal em destaque
        $featuredEpisode = Episode::published()
                                    ->featured()
                                    ->latest()
                                    ->first();
        
        //ultimos eps (menos o principal)
        $latestEpisodes = Episode::published()
                                    ->when($featuredEpisode, function($q) use ($featuredEpisode){
                                        $q->where('id', '!=', $featuredEpisode->id);
                                    })
                                    ->latest()
                                    ->limit(6)
                                    ->get();

        $categories = Category::active()
                                ->withCount('episodes')
                                ->orderBy('name')
                                ->get();

        return view('welcome', compact(
            'featuredEpisode',
            'latestEpisodes',
            'categories'
        ));
    }

    //eps por categoria
    public function byCategory(Category $category)
    {
        $episodes = Episode::published()
                            ->where('category_id', $category->id)
                            ->with(['tags', 'user'])
                            ->latest()
                            ->paginate(12);
    
        return view('episodes.by-category', compact('category', 'episodes'));
    }

    //eps por tag
    public function byTag(Tag $tag)
    {
        $episodes = $tag->episodes()
                        ->published()
                        ->with(['category', 'user'])
                        ->latest()
                        ->paginate(12);
        
        return view('episodes.by-tag', compact('tag', 'episodes'));
    }
}
