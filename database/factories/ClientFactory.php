<?php

namespace Database\Factories;

use App\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document' => $this->faker->document,
            'name' => $this->faker->name,
            'age' => $this->faker->age,
            'gender' => $this->faker->gender,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'city' => $this->faker->city,
            'pathology' => $this->faker->pathology,
            
        ];
    }
}
