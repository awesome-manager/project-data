<?php

namespace Tests\Feature\Statuses;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    private array $routes = [
        'list' => '/api/v1/statuses'
    ];

    /**
     * Check find all statuses api
     *
     * @return void
     */
    public function test_find_all():void
    {
        $response = $this->get($this->routes['list']);

        $response->assertOk()->assertJsonStructure($this->getListStruture());
    }

    /**
     * Check find specific statuses api
     *
     * @return void
     */
    public function test_find_specific()
    {
        $status = Status::factory()->create(['is_active' => true]);

        $response = $this->get("{$this->routes['list']}?ids[]={$status->id}");

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount(1, 'content.statuses');
    }

    /**
     * Check find specific statuses api
     *
     * @return void
     */
    public function test_find_specific_deactivated()
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
