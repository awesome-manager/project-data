<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected static function newFactory(): Factory
    {
        return ProjectFactory::new();
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function groupCustomer(): HasOne
    {
        return $this->hasOne(GroupCustomer::class, 'id','group_customer_id');
    }
}
