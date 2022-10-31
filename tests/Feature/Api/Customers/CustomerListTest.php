<?php

namespace Tests\Feature\Api\Customers;

use App\Models\{Customer, GroupCustomer};
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/customers';

    public function test_find_all_without_relations(): void
    {
        $customers = Customer::createList(10);

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStruture(),
            $customers->where('is_active', true)->count(),
            'content.customers'
        );
    }

    public function test_find_all_with_relations(): void
    {
        $customers = Customer::createList(10);

        GroupCustomer::createCustomList($this->createCustomData(
            rand(0, $customers->where('is_active', true)->count()),
            ['customer_id' => $customers->where('is_active', true)]
        ));

        $this->checkAssert(
            $this->get($this->route . $this->buildQuery(['with_available' => true])),
            $this->getListStruture(true)
        );
    }

    public function test_find_specific(): void
    {
        $customers = Customer::createList(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery($customers->pluck('id')->all())),
            $this->getListStruture(),
            $customers->where('is_active', true)->count(),
            'content.customers'
        );
    }

    public function test_find_specific_deactivated(): void
    {
        $customer = Customer::createEntity(['is_active' => false]);

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery([$customer->id])),
            $this->getListStruture(),
            0,
            'content.customers'
        );
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
