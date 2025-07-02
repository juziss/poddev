<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    public function run(): void
    {
        // Busca categorias e tags existentes
        $frontend = Category::where('name', 'Frontend')->first();
        $backend = Category::where('name', 'Backend')->first();
        $devops = Category::where('name', 'DevOps')->first();
        $mobile = Category::where('name', 'Mobile')->first();
        $carreira = Category::where('name', 'Carreira')->first();

        // Busca usuário de teste
        $user = User::first();

        $episodes = [
            [
                'title' => 'Introdução ao React: Do Zero ao Deploy',
                'description' => 'Neste episódio, exploramos os fundamentos do React, desde a criação de componentes até o deploy em produção.',
                'content' => '<h2>Show Notes</h2><p>Discutimos hooks, estado, props e melhores práticas. Links úteis: <a href="https://reactjs.org">React Docs</a></p>',
                'duration_seconds' => 3600, // 1 hora
                'episode_number' => 1,
                'category_id' => $frontend->id,
                'user_id' => $user->id,
                'status' => 'published',
                'featured' => true,
                'published_at' => now()->subDays(7),
                'views_count' => 1250,
                'likes_count' => 89,
                'tags' => ['React', 'JavaScript', 'Frontend']
            ],
            [
                'title' => 'Laravel: Construindo APIs Modernas',
                'description' => 'Aprenda a criar APIs robustas e escaláveis usando Laravel, com autenticação, validação e testes.',
                'content' => '<h2>Tópicos Abordados</h2><ul><li>Eloquent ORM</li><li>API Resources</li><li>Middleware</li><li>Testing</li></ul>',
                'duration_seconds' => 4200, // 1h10min
                'episode_number' => 2,
                'category_id' => $backend->id,
                'user_id' => $user->id,
                'status' => 'published',
                'featured' => false,
                'published_at' => now()->subDays(5),
                'views_count' => 890,
                'likes_count' => 67,
                'tags' => ['Laravel', 'PHP', 'API', 'Backend']
            ],
            [
                'title' => 'Docker na Prática: Containerizando Aplicações',
                'description' => 'Um guia prático de como usar Docker para desenvolver, testar e deployar aplicações de forma consistente.',
                'content' => '<h2>Comandos Essenciais</h2><pre>docker build -t app .\ndocker run -p 3000:3000 app</pre>',
                'duration_seconds' => 2700, // 45min
                'episode_number' => 3,
                'category_id' => $devops->id,
                'user_id' => $user->id,
                'status' => 'published',
                'featured' => true,
                'published_at' => now()->subDays(3),
                'views_count' => 1450,
                'likes_count' => 112,
                'tags' => ['Docker', 'DevOps', 'AWS']
            ],
            [
                'title' => 'Como Se Destacar como Desenvolvedor Júnior',
                'description' => 'Dicas práticas para quem está começando na carreira de desenvolvimento. Como evoluir rapidamente e se destacar no mercado.',
                'content' => '<h2>Principais Dicas</h2><ol><li>Contribua para projetos open source</li><li>Construa um portfólio forte</li><li>Pratique coding challenges</li></ol>',
                'duration_seconds' => 3300, // 55min
                'episode_number' => 4,
                'category_id' => $carreira->id,
                'user_id' => $user->id,
                'status' => 'published',
                'featured' => false,
                'published_at' => now()->subDays(1),
                'views_count' => 2100,
                'likes_count' => 156,
                'tags' => ['Carreira', 'Open Source', 'Git']
            ],
            [
                'title' => 'React Native vs Flutter: Qual Escolher em 2024?',
                'description' => 'Comparamos as duas principais tecnologias para desenvolvimento mobile multiplataforma.',
                'content' => '<h2>Critérios de Comparação</h2><p>Performance, curva de aprendizado, ecossistema e mercado de trabalho.</p>',
                'duration_seconds' => 3900, // 1h5min
                'episode_number' => 5,
                'category_id' => $mobile->id,
                'user_id' => $user->id,
                'status' => 'published',
                'featured' => false,
                'published_at' => now(),
                'views_count' => 756,
                'likes_count' => 43,
                'tags' => ['React', 'Mobile', 'Performance']
            ],
            [
                'title' => 'Segurança em Aplicações Web: Melhores Práticas',
                'description' => 'Aprenda a proteger suas aplicações contra as principais vulnerabilidades de segurança.',
                'content' => '<h2>Vulnerabilidades Comuns</h2><p>XSS, CSRF, SQL Injection e como preveni-las.</p>',
                'duration_seconds' => 2400, // 40min
                'episode_number' => 6,
                'category_id' => $backend->id,
                'user_id' => $user->id,
                'status' => 'draft', // Este ainda não foi publicado
                'featured' => false,
                'published_at' => null,
                'views_count' => 0,
                'likes_count' => 0,
                'tags' => ['Security', 'Database', 'API']
            ]
        ];

        foreach ($episodes as $episodeData) {
            $tags = $episodeData['tags'];
            unset($episodeData['tags']);

            $episode = Episode::create($episodeData);

            // Associa as tags ao episódio
            foreach ($tags as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $episode->tags()->attach($tag->id);
                }
            }
        }
    }
}