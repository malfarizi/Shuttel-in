<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
     /**
     * Set status to Pending
     *
     * @return void
     */
    public function setStatusPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setStatusSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setStatusFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setStatusExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }
    
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
        $total = $query->where('status', 'success')->sum('total');
        return "Rp. ".number_format($total, 0, ',', '.');
    }
}
