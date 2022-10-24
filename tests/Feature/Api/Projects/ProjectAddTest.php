<?php

namespace Tests\Feature\Api\Projects;

use App\Models\{Customer, Group, GroupCustomer, Project, Status};
use App\Traits\Tests\Queryable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectAddTest extends TestCase
{
    use Queryable, RefreshDatabase;

    private string $route = '/api/v1/projects';

    public function test_create_successful(): void
    {
        $customer = Customer::factory()->create(['is_active' => true]);
        $group = Group::factory()->create(['is_active' => true]);
        $status = Status::factory()->create(['is_active' => true]);
        GroupCustomer::factory()->create([
            'group_id' => $group->id,
            'customer_id' => $customer->id
        ]);

        $response = $this->post($this->route, $this->getValidData($group->id, $customer->id, $status->id));

        $response->assertOk()->assertJsonStructure($this->getSuccessStruture());
    }

    public function test_create_validation_error(): void
    {
        $customer = Customer::factory()->create(['is_active' => true]);
        $group = Group::factory()->create(['is_active' => true]);
        Status::factory()->create(['is_active' => true]);
        GroupCustomer::factory()->create([
            'group_id' => $group->id,
            'customer_id' => $customer->id
        ]);

        $response = $this->post($this->route, $this->getInvalidData());

        $response->assertOk()->assertJsonStructure($this->getErrorStruture())->assertJson([
            'content' => [
                'error_code' => 'validation_error'
            ]
        ]);
    }

    public function test_create_exception_error(): void
    {
        $customer = Customer::factory()->create(['is_active' => true]);
        $group = Group::factory()->create(['is_active' => true]);
        $status = Status::factory()->create(['is_active' => true]);
        GroupCustomer::factory()->create();

        $response = $this->post($this->route, $this->getValidData($group->id, $customer->id, $status->id));

        $response->assertOk()->assertJsonStructure($this->getErrorStruture())->assertJson([
            'content' => [
                'error_code' => 'group_customer_not_found'
            ]
        ]);
    }

    private function getSuccessStruture(): array
    {
        return [
            'error',
            'content' => [
                'success'
            ]
        ];
    }

    private function getErrorStruture(): array
    {
        return [
            'error',
            'content' => [
                'error_code',
                'error_message',
                'error_data'
            ]
        ];
    }

    private function getValidData(string $groupId, string $customerId, string $statusId): array
    {
        return array_merge(Project::factory()->definition(), [
            'group_id' => $groupId,
            'customer_id' => $customerId,
            'status_id' => $statusId
        ]);
    }

    private function getInvalidData(): array
    {
        return Project::factory()->definition();
    }
}
