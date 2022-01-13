<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getDriverNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function shuttle()
    {
        return $this->hasOne(Shuttle::class);
    }

    public function scopeActiveStatus($query)
    {
        return $query->where('driver_status', 'Aktif');
    }
}
