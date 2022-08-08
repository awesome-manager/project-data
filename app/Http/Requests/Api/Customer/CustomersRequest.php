<?php

namespace App\Http\Requests\Api\Customer;

use App\Http\Requests\Api\Templates\FilledIdsRequest;

class CustomersRequest extends FilledIdsRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'with_available' => 'boolean|filled'
        ]);
    }
}
