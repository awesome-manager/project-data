<?php

namespace App\Http\Controllers\Api\Project;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\ProjectsResource;
use Awesome\Foundation\Traits\Collections\Collectible;

class ProjectController extends Controller
{
    use Collectible;

    public function findProjects()
    {
        $projects = Repository::projects()->findAllActive();

        [$groupCustomers, $statuses] = [
            Repository::groupCustomer()->findByIds($this->pluckUniqueAttr($projects, 'group_customer_id')),
            Repository::statuses()->findByIds($this->pluckUniqueAttr($projects, 'status_id'))
        ];

        [$groups, $customers] = [
            Repository::groups()->findByIds($this->pluckUniqueAttr($groupCustomers, 'group_id')),
            Repository::customers()->findByIds($this->pluckUniqueAttr($groupCustomers, 'customer_id'))
        ];

        return response()->jsonResponse(
            (new ProjectsResource(
                collect(compact('projects', 'statuses', 'groupCustomers', 'groups', 'customers'))
            ))->toArray()
        );
    }
}
