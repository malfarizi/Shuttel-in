<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shuttle() 
    {
        return $this->belongsTo(Shuttle::class);    
    }

    public function schedule() {
        return $this->hasMany(Schedule::class);
    }
}
