<?php

namespace Tests\Feature\Api\Projects;

use App\Models\{Customer, Group, GroupCustomer, Project, Status};
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectAddTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/projects';

    public function test_create_successful(): void
    {
        $customer = Customer::createActiveEntity();
        $group = Group::createActiveEntity();
        $status = Status::createActiveEntity();
        GroupCustomer::createEntity([
            'group_id' => $group->id,
            'customer_id' => $customer->id
        ]);

        $this->checkAssert(
            $this->post($this->route, $this->getValidData($group->id, $customer->id, $status->id)),
            $this->getSuccessStruture()
        );
    }

    public function test_create_validation_error(): void
    {
        $customer = Customer::createActiveEntity();
        $group = Group::createActiveEntity();
        Status::createActiveEntity();
        GroupCustomer::createEntity([
            'group_id' => $group->id,
            'customer_id' => $customer->id
        ]);

        $response = $this->post($this->route, $this->getInvalidData());

        $this->checkAssert($response, $this->getErrorStruture());

        $response->assertJson([
            'content' => [
                'error_code' => 'validation_error'
            ]
        ]);
    }

    public function test_create_exception_error(): void
    {
        $customer = Customer::createActiveEntity();
        $group = Group::createActiveEntity();
        $status = Status::createActiveEntity();
        GroupCustomer::createEntity();

        $response = $this->post($this->route, $this->getValidData($group->id, $customer->id, $status->id));

        $this->checkAssert($response, $this->getErrorStruture());

        $response->assertJson([
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
