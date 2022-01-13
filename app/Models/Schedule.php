<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['route'];

    public function getDateTimeDepature() 
    {
        $date = \Carbon\Carbon::parse($this->date_of_depature)->translatedFormat('l, d F Y');
        return "$date - {$this->depature_time}";
    }

    public function route() 
    {
        return $this->belongsTo(Route::class);    
    }

    public function booking() 
    {
        return $this->hasMany(Booking::class);    
    }

    public function bookingDetail() 
    {
        return $this->hasMany(BookingDetail::class);    
    }
}
