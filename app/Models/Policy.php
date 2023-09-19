<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'policies';

    protected $fillable = [
        'uuid',
        'product_id',
        'policiable_id',
        'policiable_type',
        'policy_number',
        'policy_start_date',
        'policy_end_date',
        'premium_amount',
    ];



    public function policiable()
    {
        return $this->morphTo();
    }
}
