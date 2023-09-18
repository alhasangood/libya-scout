<?php

namespace Database\Factories;

use App\Models\Transprter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransprterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transprter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'identity' => $this->faker->text(255),
            'photo' => $this->faker->word(),
            'address' => $this->faker->text(255),
            'order_id' => \App\Models\Order::factory(),
            
            'transprter_type_id' => \App\Models\TransprterType::factory(),
        ];
    }
}
