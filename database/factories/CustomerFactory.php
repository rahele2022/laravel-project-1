<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'age'=>$this->faker->randomNumber(2),
            'name' => $this->faker->name(50),
            'family'=>$this->faker->lastName(50),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
