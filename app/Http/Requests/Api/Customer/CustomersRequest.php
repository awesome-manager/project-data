<?php

namespace App\Http\Requests\Api\Customer;

use Awesome\Rest\Requests\FilledIdsRequest;

class CustomersRequest extends FilledIdsRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'with_available' => 'filled|boolean'
        ]);
    }
}
