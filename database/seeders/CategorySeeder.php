<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Frontend',
                'description' => 'Desenvolvimento frontend, React, Vue, JavaScript e mais',
                'color' => '#3b82f6', // azul
                'active' => true
            ],
            [
                'name' => 'Backend',
                'description' => 'Desenvolvimento backend, APIs, bancos de dados e servidores',
                'color' => '#ef4444', // vermelho
                'active' => true
            ],
            [
                'name' => 'DevOps',
                'description' => 'Docker, Kubernetes, CI/CD e infraestrutura',
                'color' => '#10b981', // verde
                'active' => true
            ],
            [
                'name' => 'Mobile',
                'description' => 'Desenvolvimento mobile com React Native, Flutter, etc',
                'color' => '#8b5cf6', // roxo
                'active' => true
            ],
            [
                'name' => 'Carreira',
                'description' => 'Dicas de carreira, entrevistas e crescimento profissional',
                'color' => '#f59e0b', // amarelo
                'active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}