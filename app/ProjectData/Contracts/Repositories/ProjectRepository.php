<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ProjectRepository
{
    public function findAllActive(): Collection;
}