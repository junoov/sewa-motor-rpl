<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'motor_id',
        'pickup_location_id',
        'start_date',
        'end_date',
        'duration_days',
        'subtotal',
        'deposit_amount',
        'total_price',
        'status',
        'notes',
        'terms_accepted_at',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'terms_accepted_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'order_number';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
