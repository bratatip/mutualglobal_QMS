<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryEmailCategory extends Model
{
    use HasFactory;

    protected $table = 'primary_email_category';

    protected $fillable = [
        'uuid', 'primary_email_id','product_id',
    ];

}
