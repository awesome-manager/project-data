<?php

namespace Tests\Feature\Api\Projects;

use App\Models\Project;
use App\Traits\Tests\Queryable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectListTest extends TestCase
{
    use Queryable, RefreshDatabase;

    private string $route = '/api/v1/projects';

    public function test_find_all(): void
    {
        Project::factory()->count(10)->create();

        $response = $this->get($this->route);

        $response->assertOk()->assertJsonStructure($this->getListStruture());
    }

    private function getListStruture(): array
    {
        return [
            'error',
            'content' => [
                'projects' => [
                    '*' => [
                        'id',
                        'type',
                        'budget',
                        'title',
                        'comment',
                        'ended_at',
                        'status_id',
                        'started_at',
                        'average_rate',
                        'group_id',
                        'customer_id',
                        'expected_profitability',
                    ]
                ]
            ]
        ];
    }
}
