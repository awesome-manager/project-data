<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

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

    protected static function newFactory(): Factory
    {
        return CustomerFactory::new();
    }
}
