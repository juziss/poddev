<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Para URLs amigáveis como /episodio/meu-primeiro-episodio
            $table->text('description');
            $table->text('content')->nullable(); // Conteúdo completo/show notes
            
            // Informações do arquivo de áudio
            $table->string('audio_file')->nullable(); // Caminho do arquivo de áudio
            $table->string('audio_url')->nullable(); // URL externa do áudio (Spotify, YouTube, etc.)
            $table->integer('duration_seconds')->nullable(); // Duração em segundos
            $table->string('duration_formatted')->nullable(); // Ex: "1h 23min"
            
            // Metadados
            $table->integer('episode_number')->nullable(); // Número do episódio
            $table->integer('season_number')->default(1); // Temporada
            $table->string('thumbnail')->nullable(); // Imagem do episódio
            
            // Relacionamentos
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Quem criou
            
            // Status e visibilidade
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('featured')->default(false); // Episódio em destaque
            $table->timestamp('published_at')->nullable();
            
            // Estatísticas
            // $table->integer('views_count')->default(0);
            // $table->integer('likes_count')->default(0);
            // $table->integer('downloads_count')->default(0);
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            $table->timestamps();
            
            // Índices para otimizar consultas
            $table->index(['status', 'published_at']);
            $table->index(['category_id', 'status']);
            $table->index('featured');
            $table->index('episode_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};