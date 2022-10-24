<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFacroty extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'code' => $this->faker->unique()->word(),
            'is_active' => $this->faker->boolean()
        ];
    }
}
