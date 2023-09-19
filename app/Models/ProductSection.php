<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{
    protected $table = 'product_sections';
    use HasFactory;

    public function conditions()
    {
        return $this->hasMany(ProductCondition::class);
    }
}
