<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuttle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function route() 
    {
        return $this->hasOne(Route::class);    
    }

    public function scopeIsActiveStatus($query, $status = 'Aktif')
    {
        return $query->where('shuttle_status', $status);
    }
}
