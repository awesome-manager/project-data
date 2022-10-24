<?php

namespace Database\Factories;

use App\Models\Project;
use App\ProjectData\Enums\ProjectType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'code' => $this->faker->unique()->word(),
            'group_customer_id' => Str::uuid()->toString(),
            'type' => ProjectType::getTypes()[array_rand(ProjectType::getTypes())],
            'status_id' => Str::uuid()->toString(),
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date(),
            'budget' => $this->faker->randomNumber(7),
            'expected_profitability' => $this->faker->randomNumber(2),
            'average_rate' => $this->faker->randomNumber(4),
            'comment' => $this->faker->text(),
            'is_active' => $this->faker->boolean()
        ];
    }
}
