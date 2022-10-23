<?php

namespace App\Http\Resources\Api\Project;

use Illuminate\Database\Eloquent\Collection;
use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectsResource extends ResourceCollection
{
    use Resourceable;

    private Collection $projects;
    private Collection $groupCustomers;


    public function __construct($resource)
    {
        $this->projects = $resource->get('projects');
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
                    'ended_at' => $this->string($project->ended_at),
                    'status_id' => $this->string($project->status_id),
                    'started_at' => $this->string($project->started_at),
                    'average_rate' => $this->int($project->average_rate),
                    'group_id' => $this->string(optional($groupCustomer)->group_id),
                    'customer_id' => $this->string(optional($groupCustomer)->customer_id),
                    'expected_profitability' => $this->int($project->expected_profitability),
                ];
            })
        ];
    }
}
