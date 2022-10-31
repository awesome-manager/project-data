<?php

namespace Tests\Feature\Api\Groups;

use App\Models\{Group, GroupCustomer};
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/groups';

    public function test_find_all_without_relations(): void
    {
        Group::createList(10);

        $this->checkAssert($this->get($this->route), $this->getListStruture());
    }

    public function test_find_all_with_relations(): void
    {
        $groups = Group::createList(10);

        GroupCustomer::createCustomList($this->createCustomData(
            rand(0, $groups->where('is_active', true)->count()),
            ['customer_id' => $groups->where('is_active', true)]
        ));

        $this->checkAssert(
            $this->get($this->route . $this->buildQuery(['with_available' => true])),
            $this->getListStruture(true)
        );
    }

    public function test_find_specific(): void
    {
        $groups = Group::createList(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery($groups->pluck('id')->all())),
            $this->getListStruture(),
            $groups->where('is_active', true)->count(),
            'content.groups'
        );
    }

    public function test_find_specific_deactivated(): void
    {
        $group = Group::createEntity(['is_active' => false]);

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery([$group->id])),
            $this->getListStruture(),
            0,
            'content.groups'
        );
    }

    private function getListStruture(bool $withRelation = false): array
    {
        $structure = [
            'error',
            'content' => [
                'groups' => [
                    '*' => [
                        'id',
                        'code',
                        'title',
                    ]
                ]
            ]
        ];

        if ($withRelation) {
            $structure['content']['available_customers'] = [
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
