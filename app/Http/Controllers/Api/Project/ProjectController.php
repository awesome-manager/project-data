<?php

namespace App\Http\Controllers\Api\Project;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Project\{CreateRequest, FindRequest};
use App\Http\Resources\Api\Project\ProjectsResource;
use App\ProjectData\Contracts\Services\ProjectService;
use Awesome\Foundation\Traits\Collections\Collectible;
use Awesome\Rest\Resources\SuccessResource;

class ProjectController extends Controller
{
    use Collectible;

    public function findProjects(FindRequest $request, ProjectService $service)
    {
        $projects = $service->find(
            $request->query('ids', []),
            $request->query('active_only', false)
        );

        $groupCustomers =  Repository::groupCustomer()->findByIds(
            $this->pluckUniqueAttr($projects, 'group_customer_id')
        );

        return response()->jsonResponse(
            (new ProjectsResource(
                collect(compact('projects', 'groupCustomers'))
            ))->toArray()
        );
    }

    public function createProject(CreateRequest $request, ProjectService $service)
    {
        return response()->jsonResponse((new SuccessResource(
            ['success' => $service->create($request->validated())]
        ))->toArray());
    }
}
