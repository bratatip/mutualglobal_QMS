<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvertedInsurer extends Model
{
    use HasFactory;
    public $timestamps = false;
 
    protected $table = 'converted_insurers';

    protected $fillable = [
        'uuid', 
        'convertable_type', 
        'convertable_id', 
        'insurer_id', 
        'share_in_percentage',
    ];

    public function convertable()
    {
        return $this->morphTo();
    }

    // public function insurer()
    // {
    //     return $this->belongsTo(QuoteGenerate::class, 'insurer_id');
    // }

    public function insurer()
    {
        return $this->belongsTo(Insurer::class, 'insurer_id', 'id');
    }
    
}
