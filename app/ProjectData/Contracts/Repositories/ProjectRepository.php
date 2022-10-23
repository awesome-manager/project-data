<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\{Model, Collection};

interface ProjectRepository
{
    public function findAllActive(): Collection;

    public function create(array $properties): ?Model;
}
