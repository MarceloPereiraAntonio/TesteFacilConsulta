<?php

namespace Database\Seeders;

use App\Models\Cidade;
use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        Cidade::factory(5)->create()->each(function ($cidade) {
            Medico::factory(3)->create(['cidade_id' => $cidade->id]);
        });

        Paciente::factory(10)->create();
        Consulta::factory(15)->create();
    }
}
