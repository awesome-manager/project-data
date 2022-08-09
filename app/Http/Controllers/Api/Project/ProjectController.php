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

        $groupCustomers =  Repository::groupCustomer()->findByIds(
            $this->pluckUniqueAttr($projects, 'group_customer_id')
        );

        return response()->jsonResponse(
            (new ProjectsResource(
                collect(compact('projects', 'groupCustomers'))
            ))->toArray()
        );
    }
}
