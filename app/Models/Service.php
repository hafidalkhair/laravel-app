<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'image',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
    ];

    /**
     * Get the bookings for the service.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
