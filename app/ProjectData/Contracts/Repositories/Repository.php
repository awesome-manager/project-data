<?php

namespace App\ProjectData\Contracts\Repositories;

interface Repository
{
    public function projects(): ProjectRepository;

    public function groupCustomer(): GroupCustomerRepository;
}
