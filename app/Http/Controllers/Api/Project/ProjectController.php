<?php

namespace App\Http\Controllers\Api\Project;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\ProjectsResource;

class ProjectController extends Controller
{
    public function findProjects()
    {
        $projects = Repository::projects()->findAllActive();

        [$groupCustomers, $statuses] = [
            Repository::groupCustomer()->findByIds(
                $projects->pluck('group_customer_id')->unique()->all()
            ),
            Repository::statuses()->findByIds(
                $projects->pluck('status_id')->unique()->all()
            )
        ];

        [$groups, $customers] = $groupCustomers->isNotEmpty() ? [
            Repository::groups()->findByIds(
                $groupCustomers->pluck('group_id')->unique()->all()
            ),
            Repository::customers()->findByIds(
                $groupCustomers->pluck('customer_id')->unique()->all()
            )
        ] : [collect(), collect()];

        return response()->jsonResponse(
            (new ProjectsResource(
                collect(compact('projects', 'statuses', 'groupCustomers', 'groups', 'customers'))
            ))->toArray()
        );
    }
}
