<?php

namespace App\Http\Controllers\Api\Project;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
//use App\Http\Resources\Api\Position\ProjectsResource;

class ProjectController extends Controller
{
    public function findProjects()
    {
        $projects = Repository::projects()->findAllActive();

        dd(Repository::projects()->findAllActive());
//        return response()->jsonResponse((new ProjectsResource(Repository::projects()->findAllActive()))->toArray());
    }
}
