<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //criar usuário de teste
        User::factory()->create([
            'name' => 'Juping Kernel da Silva',
            'email' => 'jupinga@poddev.com',
        ]);

        //rodar seeders em ordem
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            EpisodeSeeder::class,
        ]);
    }
}