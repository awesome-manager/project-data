<?php

namespace App\ProjectData\Contracts\Services;

use Illuminate\Database\Eloquent\Model;

interface ProjectService
{
    public function create(array $properties): ?Model;
}
