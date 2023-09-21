<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskOccupancy extends Model
{
    use HasFactory;

    // public $timestamps = false;

    protected $table = 'risk_occupancies';

    protected $fillable = [
        'uuid',
        'iib_code',
        'risk_occupancy',
        'risk_code'
     
    ];
}
