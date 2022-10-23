<?php

namespace App\Exceptions;

use Awesome\Rest\Exceptions\AbstractException;

class GroupCustomerNotFoundException extends AbstractException
{
    const SYMBOLIC_CODE = 'group_customer_not_found';
}
