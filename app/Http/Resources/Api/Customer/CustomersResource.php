<?php

namespace App\Http\Resources\Api\Customer;

use Illuminate\Database\Eloquent\Collection;
use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomersResource extends ResourceCollection
{
    use Resourceable;

    private Collection $customers;
    private ?Collection $groupCustomer;

    public function __construct($resource)
    {
        $this->customers = $resource->get('customers');
        $this->groupCustomer = $resource->get('groupCustomer');

        parent::__construct($resource);
    }

    public function toArray($request = null)
    {
        $res = [
            'customers' => $this->customers->map(function ($customer) {
                return [
                    'id' => $this->string($customer->id),
                    'name' => $this->string($customer->name),
                    'surname' => $this->string($customer->surname)
                ];
            })
        ];

        if ($this->groupCustomer) {
            $res[ 'available_projects'] = $this->groupCustomer->map(function ($groupCustomer) {
                return [
                    'id' => $this->string($groupCustomer->id),
                    'group_id' => $this->string($groupCustomer->group_id),
                    'customer_id' => $this->string($groupCustomer->customer_id)
                ];
            });
        }

        return $res;
    }
}
