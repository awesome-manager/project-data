<?php

namespace App\ProjectData\Contracts\Services;

use Illuminate\Database\Eloquent\{Collection, Model};

interface ProjectService
{
    public function create(array $properties): ?Model;

    public function find(array $ids = [], bool $activeOnly = true): Collection;
}
