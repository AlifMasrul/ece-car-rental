<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'start_date',
        'end_date',
        'cancellation_requested_at', // Make sure this is in fillable if you're mass-assigning
        'cancellation_status',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'cancellation_requested_at' => 'datetime', // This will cast it to a Carbon instance
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id'); // Assuming your user ID foreign key in the bookings table is 'customer_id'
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_booking', 'booking_id', 'car_id');
    }
}
