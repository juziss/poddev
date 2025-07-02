<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'JavaScript', 'color' => '#f7df1e'],
            ['name' => 'PHP', 'color' => '#777bb4'],
            ['name' => 'Laravel', 'color' => '#ff2d20'],
            ['name' => 'React', 'color' => '#61dafb'],
            ['name' => 'Vue.js', 'color' => '#4fc08d'],
            ['name' => 'Node.js', 'color' => '#339933'],
            ['name' => 'Docker', 'color' => '#2496ed'],
            ['name' => 'AWS', 'color' => '#ff9900'],
            ['name' => 'Git', 'color' => '#f05032'],
            ['name' => 'API', 'color' => '#6366f1'],
            ['name' => 'Database', 'color' => '#336791'],
            ['name' => 'Testing', 'color' => '#c21325'],
            ['name' => 'Performance', 'color' => '#10b981'],
            ['name' => 'Security', 'color' => '#ef4444'],
            ['name' => 'Open Source', 'color' => '#24292e']
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}