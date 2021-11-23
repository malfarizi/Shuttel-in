<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function schedule() 
    {
        return $this->belongsTo(Schedule::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function bookingDetails() 
    {
        return $this->hasMany(BookingDetail::class)->orderBy('seat_number');    
    }
}
