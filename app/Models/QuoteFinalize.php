<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteFinalize extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'quote_finalizes';
 
    protected $fillable = [
        'uuid', 'finalizable_type', 'finalizable_id', 'insurer_id', 'net_premium', 'gst'
    ];

    public function finalizable()
    {
        return $this->morphTo();
    }

    public function insurers()
    {
        return $this->belongsTo(Insurer::class);
    }

    public function insurer()
    {
        return $this->belongsTo(Insurer::class, 'insurer_id');
    }
}
