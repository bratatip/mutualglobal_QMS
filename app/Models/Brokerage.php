<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brokerage extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'brokerages';

    protected $fillable = [
        'uuid',
        'brokerageable_type', 
        'brokerageable_id', 
        'brokerage_amount',
        'brokerage_rewards'
    ];

    public function brokerageable()
    {
        return $this->morphTo();
    }

    public function insurer()
    {
        return $this->belongsTo(QuoteGenerate::class, 'id');
    }
    
}
 