<?php

namespace Tests\Feature\Api\Statuses;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    private array $routes = [
        'list' => '/api/v1/statuses'
    ];

    public function test_find_all(): void
    {
        Status::factory()->count(10)->create();

        $response = $this->get($this->routes['list']);

        $response->assertOk()->assertJsonStructure($this->getListStruture());
    }

    public function test_find_specific(): void
    {
        $status = Status::factory()->create(['is_active' => true]);

        $response = $this->get("{$this->routes['list']}?ids[]={$status->id}");

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount(1, 'content.statuses');
    }

    public function test_find_specific_deactivated(): void
    {
        $status = Status::factory()->create(['is_active' => false]);

        $response = $this->get("{$this->routes['list']}?ids[]={$status->id}");

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount(0, 'content.statuses');
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
