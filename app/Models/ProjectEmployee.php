<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    protected $table = 'project_employee';

    protected $primaryKey = false;

    public $timestamps = false;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'employee_id',
        'position_id'
    ];
}
