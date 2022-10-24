<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Database\Factories\GroupFacroty;
use Illuminate\Database\Eloquent\Factories\{Factory, HasFactory};
use Illuminate\Database\Eloquent\Model;

class Group extends Model
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
        return GroupFacroty::new();
    }
}
