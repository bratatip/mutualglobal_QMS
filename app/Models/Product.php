<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use HasFactory;

    public function conditions()
    {
        return $this->hasMany(ProductCondition::class);
    }

    public function primaryEmails() {
        return $this->belongsToMany(PrimaryEmail::class, 'primary_email_category', 'product_id', 'primary_email_id');
    }
}
 