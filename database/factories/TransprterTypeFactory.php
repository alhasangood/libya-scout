<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TransprterType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransprterTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransprterType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(255),
            'status' => $this->faker->randomNumber(),
        ];
    }
}
