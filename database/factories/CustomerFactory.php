<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birthday' => $this->faker->date(),
            'phone' => $this->generateValidPhoneNumber(),
            'email' => $this->faker->email(),
            'is_active' => $this->faker->boolean()
        ];
    }

    private function generateValidPhoneNumber(int $length = 11): string
    {
        $characters = '1234567890';
        $charactersLength = strlen($characters);

        $res = '7';
        for ($i = 0; $i < $length - 1; $i++) {
            $res .= $characters[rand(0, $charactersLength - 1)];
        }

        return $res;
    }
}
