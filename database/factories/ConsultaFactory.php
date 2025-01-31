<?php

namespace Database\Factories;

use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consulta>
 */
class ConsultaFactory extends Factory
{
    protected $model = Consulta::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medico_id' => Medico::factory(),
            'paciente_id' => Paciente::factory(),
            'data' => $this->faker->dateTimeBetween('+1 days', '+1 month')
        ];
    }
}
