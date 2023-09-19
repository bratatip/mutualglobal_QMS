<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCondition extends Model
{
    public $timestamps = false;

    protected $table = 'product_conditions';
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_section_id',
        'product_sub_section_id',
        'content'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship with the ProductSection model
    public function productSection()
    {
        return $this->belongsTo(ProductSection::class);
    }

    // Define the relationship with the ProductSubSection model
    public function productSubSection()
    {
        return $this->belongsTo(ProductSubSection::class);
    }
}
