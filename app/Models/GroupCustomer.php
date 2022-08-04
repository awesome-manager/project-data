<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Awesome\Foundation\Traits\AwesomeModel;

class GroupCustomer extends Model
{
    use AwesomeModel;

    protected $table = 'group_customer';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'customer_id'
    ];

    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
