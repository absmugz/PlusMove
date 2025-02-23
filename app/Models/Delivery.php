<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'status', 'assigned_at', 'city_id'];

    /**
     * Define the relationship with the driver (User model)
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
