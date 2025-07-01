<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Episode extends Model
{
    /** @use HasFactory<\Database\Factories\EpisodeFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description', 
        'content',
        'audio_file',
        'audio_url',
        'duration_seconds',
        'duration_formatted',
        'episode_number',
        'season_number',
        'thumbnail',
        'category_id',
        'user_id',
        'status',
        'featured',
        'published_at',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'downloads_count' => 'integer'
    ];

    //RELACIONAMENTOS
    //pertence a uma categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //pertece a um usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //pertence a varias tags n:n
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'episode_tag')
                ->withTimestamps();
    }

    //MUTATORS

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //convertendo p horário + legível tipo 1h 13 min
    public function setDurationSecondsAttribute($value)
    {
        $this->attributes[ 'duration_seconds'] = $value;

        if ($value){
            $hours = floor($value / 3600);
            $minutes = floor(($value % 3600) / 60);

            if ($hours > 0){
                $this->attributes['duration_formatted'] = "{$hours}h {$minutes}min";
            } else {
                $this->attributes['duration_formatted'] = "{$minutes}min";
            }
        }
    }
    
    //ACCESSORS
    
    public function getExcerpAttributes()
    {
        return Str::limit($this->description, 150);
    }

    public function getPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : null;
    }

    //SCOPES

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                        ->whereNotNull('published_at')
                        ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    //MÉTODOS BACANUDOS
    public function isPublished()
    {
        return $this->status === 'published' && 
               $this->published_at && 
               $this->published_at <= now();
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function getRouteKeyName()
    {
        return 'slug'; // Permite usar slug nas rotas em vez do ID
    }

    //executa automaticamente em eventos do model
    protected static function boot()
    {
        parent::boot();
        
        // Quando criar um episódio, definir published_at se status for 'published'
        static::creating(function ($episode) {
            if ($episode->status === 'published' && !$episode->published_at) {
                $episode->published_at = now();
            }
        });
    }
}
