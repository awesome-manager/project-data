<?php

namespace App\Models;

use Database\Factories\StatusFactory;
use Illuminate\Database\Eloquent\Factories\{Factory, HasFactory};
use Illuminate\Database\Eloquent\Model;
use Awesome\Foundation\Traits\Models\AwesomeModel;

class Status extends Model
{
    use AwesomeModel, HasFactory;

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

    public static function factory(): Factory
    {
        return StatusFactory::new();
    }
}
