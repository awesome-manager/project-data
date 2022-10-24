<?php

namespace Tests\Feature\Api\Customers;

use App\Models\{Customer, GroupCustomer};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    private array $routes = [
        'list' => '/api/v1/customers'
    ];

    public function test_find_all_without_relations(): void
    {
        Customer::factory()->count(10)->create();

        $response = $this->get($this->routes['list']);

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

        $response = $this->get("{$this->routes['list']}?with_available=1");

        $response->assertOk()->assertJsonStructure($this->getListStruture(true));
    }

    public function test_find_specific(): void
    {
        $customers = Customer::factory()->count(rand(1, 10))->create();

        $response = $this->get(
            "{$this->routes['list']}?{$this->getIdsQuery($customers->pluck('id')->all())}"
        );

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount($customers->where('is_active', true)->count(), 'content.customers');
    }

    public function test_find_specific_deactivated(): void
    {
        $customer = Customer::factory()->create(['is_active' => false]);

        $response = $this->get("{$this->routes['list']}?{$this->getIdsQuery([$customer->id])}");

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
            $structure['content']['available_projects'] = [
                '*' => [
                    'id',
                    'group_id',
                    'customer_id'
                ]
            ];
        }

        return $structure;
    }

    private function getIdsQuery(array $ids): string
    {
        return implode('&ids[]=', $ids);
    }
}
