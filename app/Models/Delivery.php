<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'status', 'assigned_at'];

    /**
     * Define the relationship with the driver (User model)
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
