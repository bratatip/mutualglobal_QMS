<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use HasFactory;


    protected $fillable = [
        'uuid', 'name', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id');
    }
    

    public function conditions()
    {
        return $this->hasMany(ProductCondition::class);
    }

    public function primaryEmails()
    {
        return $this->belongsToMany(PrimaryEmail::class, 'primary_email_category', 'product_id', 'primary_email_id');
    }
}
