<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function route() 
    {
        return $this->belongsTo(Route::class);    
    }

    public function booking() 
    {
        return $this->hasMany(Booking::class)->withCount('booking');    
    }

    public function bookingDetail() 
    {
        return $this->hasMany(BookingDetail::class);    
    }
}
