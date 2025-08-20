<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function PHPUnit\Framework\assertIsReadable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this -> faker -> words(3,true),
            'address' => $this -> faker -> address,
            'area' => $this -> faker -> numberBetween(20, 200),
            'price' => $this -> faker -> randomFloat(2, 100000, 1000000),
            'description' => $this -> faker -> optional()->paragraph(),
        ];
    }
}
