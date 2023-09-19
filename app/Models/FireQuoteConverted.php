<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireQuoteConverted extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'fire_quote_converteds';

    protected $fillable = [
        'uuid',
        'firepremiable_type',
        'firepremiable_id',
        'net_od_premium', 
        'net_terrorism_premium', 
        'gst',
        'gross_premium'
    ];

    public function firepremiable()
    {
        return $this->morphTo();
    }

    public function insurer()
    {
        return $this->belongsTo(QuoteGenerate::class, 'id');
    }
    
}
