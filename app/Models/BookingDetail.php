<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function booking() 
    {
        return $this->belongsTo(Booking::class);    
    }
    
    public function schedule() 
    {
        return $this->belongsTo(Schedule::class);
    }
}
