<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'number',
        'type'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}