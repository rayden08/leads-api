<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name'
    ];

    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class, 'province_code', 'code');
    }
}