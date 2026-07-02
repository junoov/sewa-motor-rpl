<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorType extends Model
{
    protected $fillable = ['name', 'slug'];

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }
}
