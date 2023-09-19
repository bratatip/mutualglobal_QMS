<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'payments';

    protected $fillable = [
        'uuid',
        'email', 
        'paymentable_type', 
        'paymentable_id', 
        'transaction_number', 
        'transaction_amount',
        'transaction_date',
        'transaction_mode',
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function insurer()
    {
        return $this->belongsTo(Insurer::class, 'insurer_id');
    }
}
