<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTotalAttribute($value)
    {
        return "Rp. ".number_format($value, 0, ',', '.');
    }

    public function getDateAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->translatedFormat('l, d F Y');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeTotalIncome($query)
    {
        return $query->whereIn('status', ['capture', 'settlement'])->sum('total');
    }
}
