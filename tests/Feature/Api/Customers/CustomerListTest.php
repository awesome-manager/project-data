<?php

namespace Tests\Feature\Api\Customers;

use App\Models\{Customer, GroupCustomer};
use App\Traits\Tests\Queryable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerListTest extends TestCase
{
    use Queryable, RefreshDatabase;

    private string $route = '/api/v1/customers';

    public function test_find_all_without_relations(): void
    {
        Customer::factory()->count(10)->create();

        $response = $this->get($this->route);

        $response->assertOk()->assertJsonStructure($this->getListStruture());
    }

    public function test_find_all_with_relations(): void
    {
        $customers = Customer::factory()->count(10)->create();

        $customers->each(function ($customer) {
            if ($customer->is_active && rand(0, 1)) {
                GroupCustomer::factory()->create([
                    'customer_id' => $customer->id
                ]);
            }
        });

        $response = $this->get($this->route . $this->buildQuery([
            'with_available' => true
        ]));

        $response->assertOk()->assertJsonStructure($this->getListStruture(true));
    }

    public function test_find_specific(): void
    {
        $customers = Customer::factory()->count(rand(1, 10))->create();

        $response = $this->get(
            $this->route . $this->buildIdsQuery($customers->pluck('id')->all())
        );

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount($customers->where('is_active', true)->count(), 'content.customers');
    }

    public function test_find_specific_deactivated(): void
    {
        $customer = Customer::factory()->create(['is_active' => false]);

        $response = $this->get($this->route . $this->buildIdsQuery([$customer->id]));

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount(0, 'content.customers');
    }

    private function getListStruture(bool $withRelation = false): array
    {
        $structure = [
            'error',
            'content' => [
                'customers' => [
                    '*' => [
                        'id',
                        'name',
                        'surname',
                    ]
                ]
            ]
        ];

        if ($withRelation) {
            $structure['content']['available_groups'] = [
                '*' => [
                    'id',
                    'group_id',
                    'customer_id'
                ]
            ];
        }

        return $structure;
    }
}
