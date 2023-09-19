<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteGenerate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'quote_generate';

    protected $fillable = [
        'customer_id',
        'uuid',
        'quote_no',
        'risk_location',
        'risk_occupancy_id',
        'policy_type',
        'claim_status',
        'year_of_claim',
        'cause_of_loss',
        'claim_amount',
        'buildings_and_other_structural_work',
        'plants_and_machines',
        'mbd',
        'electrical_fittings',
        'eei',
        'computer_and_all_movables',
        'furniture_and_fittings',
        'stock_in_process',
        'finished_good',
        'fassade_glasses',
        'pgi',
        'loss_of_rent',
        'no_of_months_loss',
        'business_interuption',
        'bi_no_of_months',
        'basement_risk',
        'total_sum_insured',
        'terrorism',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function riskOccupancy()
    {
        return $this->belongsTo(RiskOccupancy::class, 'risk_occupancy_id');
    }

    public function insurer()
    {
        return $this->belongsTo(Insurer::class, 'insurer_id');
    }

    public function quoteFinalize()
    {
        return $this->morphMany(QuoteFinalize::class, 'finalizable');
    }

    public function convertedInsurer()
    {
        return $this->morphMany(ConvertedInsurer::class, 'convertable');
    }

    public function payment()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function policy()
    {
        return $this->morphMany(Policy::class, 'policiable');
    }
}
