<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPriceRupiahAttribute()
    {
        return "Rp. ".number_format($this->price, 0, ',', '.');
    }

    public function getDepatureArrivalAttribute() 
    {
        return "{$this->depature} - {$this->arrival}";
    }

    public function shuttle() 
    {
        return $this->belongsTo(Shuttle::class);    
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
