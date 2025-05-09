<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'type',
        'transmission',
        'brand',
        'model',
        'branch_id',
    ];

    // Define the relationship with Branch (assuming you have a Branch model)
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
