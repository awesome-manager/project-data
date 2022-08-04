<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Awesome\Foundation\Traits\AwesomeModel;

class Customer extends Model
{
    use AwesomeModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'surname',
        'birthday',
        'is_active'
    ];

    protected $casts = [
        'birthday'
    ];
}
