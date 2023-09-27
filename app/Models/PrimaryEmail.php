<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryEmail extends Model
{
    use HasFactory;

    protected $table = 'primary_emails';

    protected $fillable = [
        'uuid', 'email','insurer_id',
    ];

    public function insurer() {
        return $this->belongsTo(Insurer::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'primary_email_category', 'primary_email_id', 'product_id');
    }

    public function ccEmails() {
        return $this->belongsToMany(CCEmail::class, 'primary_email_cc_email', 'primary_email_id', 'cc_email_id');
    }
}
