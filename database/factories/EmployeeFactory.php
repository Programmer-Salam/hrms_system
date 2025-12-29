<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory {
    public function definition(): array {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'department_id' => fake()->numberBetween(1, 5),
        ];
    }
}
