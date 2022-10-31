<?php

namespace Tests\Feature\Api\Statuses;

use App\Models\Status;
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/statuses';

    public function test_find_all(): void
    {
        Status::createList(10);

        $this->checkAssert($this->get($this->route), $this->getListStruture());
    }

    public function test_find_specific(): void
    {
        $status = Status::createActiveEntity();

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery([$status->id])),
            $this->getListStruture(),
            1,
            'content.statuses'
        );
    }

    public function test_find_specific_deactivated(): void
    {
        $status = Status::createEntity(['is_active' => false]);

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery([$status->id])),
            $this->getListStruture(),
            0,
            'content.statuses'
        );
    }

    private function getListStruture(): array
    {
        return [
            'error',
            'content' => [
                'statuses' => [
                    '*' => [
                        'id',
                        'code',
                        'title',
                    ]
                ]
            ]
        ];
    }
}
