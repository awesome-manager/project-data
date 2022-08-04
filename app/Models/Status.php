<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Awesome\Foundation\Traits\Models\AwesomeModel;

class Status extends Model
{
    use AwesomeModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'title',
        'is_active'
    ];
}
