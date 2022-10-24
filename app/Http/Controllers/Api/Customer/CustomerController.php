<?php

namespace App\Http\Controllers\Api\Customer;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\CustomersRequest;
use App\Http\Resources\Api\Customer\CustomersResource;
use Awesome\Foundation\Traits\Collections\Collectible;

class CustomerController extends Controller
{
    use Collectible;

    public function findCustomers(CustomersRequest $request)
    {
        $customers = $request->has('ids')
            ? Repository::customers()->findByIds($request->query('ids', []))
            : Repository::customers()->findAllActive();

        $groupCustomer = $request->query('with_available')
            ? Repository::groupCustomer()->findByCustomers($this->pluckUniqueAttr($customers, 'id'))
            : collect();

        return response()->jsonResponse(
            (new CustomersResource(collect(compact('customers', 'groupCustomer'))))->toArray($request)
        );
    }
}
