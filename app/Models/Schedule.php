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

    public function bookings() 
    {
        return $this->hasMany(Booking::class);    
    }

    public function bookingDetail() 
    {
        return $this->hasMany(BookingDetail::class);    
    }
}
