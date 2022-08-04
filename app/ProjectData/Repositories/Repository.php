<?php

namespace App\ProjectData\Repositories;

use App\ProjectData\Contracts\Repositories;
use App\ProjectData\Contracts\Repositories\Repository as RepositoryContract;

class Repository implements RepositoryContract
{
    public function projects(): Repositories\ProjectRepository
    {
        return app(Repositories\ProjectRepository::class);
    }
}
