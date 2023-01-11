<?php

namespace Tests\Feature\Api\Projects;

use App\Models\Project;
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/projects';

    public function test_find_all(): void
    {
        $projects = Project::createList(10);

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStructure(),
            $projects->count(),
            'content.projects'
        );
    }

    public function test_find_all_active(): void
    {
        $projects = Project::createList(10);

        $this->checkAssert(
            $this->get($this->route . $this->buildQuery(['active_only' => 1])),
            $this->getListStructure(),
            $projects->where('is_active', true)->count(),
            'content.projects'
        );
    }

    public function test_find_by_ids(): void
    {
        $projects = Project::createList(10);

        $randomProjects = $projects->random(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery($randomProjects->pluck('id')->all())),
            $this->getListStructure(),
            $randomProjects->count(),
            'content.projects'
        );
    }

    public function test_find_active_by_ids(): void
    {
        $projects = Project::createList(10);

        $randomProjects = $projects->random(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildQuery([
                    'ids' => $randomProjects->pluck('id')->all(),
                    'active_only' => 1
                ])
            ),
            $this->getListStructure(),
            $randomProjects->where('is_active', true)->count(),
            'content.projects'
        );
    }

    private function getListStructure(): array
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
