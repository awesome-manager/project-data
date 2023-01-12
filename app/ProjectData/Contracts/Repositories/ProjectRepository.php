<?php

namespace App\ProjectData\Contracts\Repositories;

use Illuminate\Database\Eloquent\{Collection, Model};

interface ProjectRepository
{
    public function findAllActive(): Collection;

    public function findAll(): Collection;

    public function findByIds(array $ids, bool $activeOnly = true): Collection;

    public function create(array $properties): ?Model;
}
