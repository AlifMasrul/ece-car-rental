<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand',
        'model',
        'plate_number',
        'transmission',
        'type',
        'branch_id',
        'year', // Add this
        'price', // Add this
    ];

    // Define the relationship with Branch (assuming you have a Branch model)
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
