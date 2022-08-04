<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Awesome\Foundation\Traits\AwesomeModel;

class Project extends Model
{
    use AwesomeModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'type',
        'title',
        'budget',
        'comment',
        'ended_at',
        'is_active',
        'status_id',
        'started_at',
        'average_rate',
        'group_customer_id',
        'expected_profitability'
    ];

    protected $casts = [
        'started_at',
        'ended_at',
    ];

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function groupCustomer()
    {
        return $this->hasOne(GroupCustomer::class, 'id','group_customer_id');
    }
}
