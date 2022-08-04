<?php

namespace App\Http\Resources\Api\Project;

use Illuminate\Database\Eloquent\Collection;
use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectsResource extends ResourceCollection
{
    use Resourceable;

    private Collection $groups;
    private Collection $projects;
    private Collection $statuses;
    private Collection $customers;
    private Collection $groupCustomers;


    public function __construct($resource)
    {
        $this->groups = $resource->get('groups');
        $this->projects = $resource->get('projects');
        $this->statuses = $resource->get('statuses');
        $this->customers = $resource->get('customers');
        $this->groupCustomers = $resource->get('groupCustomers')->keyBy('id');

        parent::__construct($resource);
    }

    public function toArray($request = null)
    {
        return [
            'projects' => $this->projects->map(function ($project) {
                $groupCustomer = $this->groupCustomers->get($project->group_customer_id);

                return [
                    'id' => $this->string($project->id),
                    'type' => $this->string($project->type),
                    'budget' => $this->int($project->budget),
                    'title' => $this->string($project->title),
                    'comment' => $this->string($project->comment),
                    'status_id' => $this->string($project->status_id),
                    'average_rate' => $this->int($project->average_rate),
                    'group_id' => $this->string(optional($groupCustomer)->group_id),
                    'customer_id' => $this->string(optional($groupCustomer)->customer_id),
                    'expected_profitability' => $this->int($project->expected_profitability),
                ];
            }),
            'statuses' => $this->statuses->map(function ($status) {
                return [
                    'id' => $this->string($status->id),
                    'code' => $this->string($status->code),
                    'title' => $this->string($status->title),
                ];
            }),
            'groups' => $this->groups->map(function ($group) {
                return [
                    'id' => $this->string($group->id),
                    'code' => $this->string($group->code),
                    'title' => $this->string($group->title),
                ];
            }),
            'customers' => $this->customers->map(function ($customer) {
                return [
                    'id' => $this->string($customer->id),
                    'name' => $this->string($customer->name),
                    'surname' => $this->string($customer->surname),
                ];
            })
        ];
    }
}
