<?php

namespace Database\Factories;

use App\Models\GroupCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GroupCustomerFactory extends Factory
{
    protected $model = GroupCustomer::class;

    public function definition(): array
    {
        return [
            'group_id' => Str::uuid()->toString(),
            'customer_id' => Str::uuid()->toString()
        ];
    }
}
