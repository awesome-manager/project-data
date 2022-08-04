<?php

namespace App\ProjectData\Contracts\Repositories;

interface Repository
{
    public function groups(): GroupRepository;

    public function statuses(): StatusRepository;

    public function projects(): ProjectRepository;

    public function customers(): CustomerRepository;

    public function groupCustomer(): GroupCustomerRepository;
}
