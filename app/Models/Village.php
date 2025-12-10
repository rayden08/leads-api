<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'district_code',
        'postal_code'
    ];

    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
}