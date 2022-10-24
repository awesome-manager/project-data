<?php

namespace Tests\Feature\Api\Groups;

use App\Models\{Group, GroupCustomer};
use App\Traits\Tests\Queryable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use Queryable, RefreshDatabase;

    private array $routes = [
        'list' => '/api/v1/groups'
    ];

    public function test_find_all_without_relations(): void
    {
        Group::factory()->count(10)->create();

        $response = $this->get($this->routes['list']);

        $response->assertOk()->assertJsonStructure($this->getListStruture());
    }

    public function test_find_all_with_relations(): void
    {
        $groups = Group::factory()->count(10)->create();

        $groups->each(function ($group) {
            if ($group->is_active && rand(0, 1)) {
                GroupCustomer::factory()->create([
                    'customer_id' => $group->id
                ]);
            }
        });

        $response = $this->get($this->routes['list'] . $this->buildQuery([
            'with_available' => true
        ]));

        $response->assertOk()->assertJsonStructure($this->getListStruture(true));
    }

    public function test_find_specific(): void
    {
        $groups = Group::factory()->count(rand(1, 10))->create();

        $response = $this->get(
            $this->routes['list'] . $this->buildIdsQuery($groups->pluck('id')->all())
        );

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount($groups->where('is_active', true)->count(), 'content.groups');
    }

    public function test_find_specific_deactivated(): void
    {
        $group = Group::factory()->create(['is_active' => false]);

        $response = $this->get(
            $this->routes['list'] . $this->buildIdsQuery([$group->id])
        );

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount(0, 'content.groups');
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
