<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color'
    ];

    //relacionamento n:n, uma tag pode ter varios eps
    // e um ep pode ter varias tags
    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'episode_tag')
                    ->withTimestamps(); //inclui created_at/updated_at na tabela
    }

    //gera slug automaticamente
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //title case
    public function getNameAttribute($value)
    {
        return Str::title($value);
    }

    //quantidade de eps com a tag em específico
    public function publishedEpisodesCount()
    {
        return $this->episodes()
                    ->where('status', 'published')
                    ->count();
    }
}

