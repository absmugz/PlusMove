<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_id', 'customer_id', 'status'];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}

