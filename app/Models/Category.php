<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    //campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'active'
    ];

    //conversão automática de tipos (casting)
    protected $casts = [
        'active' => 'boolean',
    ];

    //uma categoria possui vários eps
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    //formata o nome sempre em Title Case
    public function getNameAttribute($value)
    {
        return Str::title($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //query p/ buscar apenas categorias ativas
    //scopes são métodos reutilizáveis para queries
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    //método p/ contar episódios publicados da categoria
    public function publishedEpisodeCount()
    {
        return $this->episodes()->where('status', 'published')->count();
    }
}
