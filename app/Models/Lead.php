<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Lead extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes; 
    
    protected $dates = ['deleted_at']; 

    protected $fillable = [
        'name',
        'description',
        'status',
        'customer_id',
        'product_id',
        'user_id'
    ];

    protected $casts = [
        'status' => LeadStatus::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isConverted()
    {
        return $this->status === LeadStatus::CONVERTED;
    }
}