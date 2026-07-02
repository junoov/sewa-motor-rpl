<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Motor extends Model
{
    protected $fillable = [
        'brand_id',
        'motor_type_id',
        'location_id',
        'name',
        'slug',
        'image_path',
        'year',
        'cc',
        'transmission',
        'plate_number_masked',
        'price_per_day',
        'deposit_amount',
        'rating',
        'reviews_count',
        'status',
        'tone',
        'description',
        'is_popular',
    ];

    protected function casts(): array
    {
        return [
            'is_popular' => 'boolean',
            'rating' => 'decimal:1',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): string
    {
        $path = $this->image_path;

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(MotorType::class, 'motor_type_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function isWishlistedBy(User $user): bool
    {
        return $this->wishlists()->where('user_id', $user->id)->exists();
    }
}
