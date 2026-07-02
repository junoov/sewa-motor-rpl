<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'logo_path'];

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }
}
