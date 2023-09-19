<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'customers'; 

    protected $fillable = [
        'name', 'email', 'address','zip_code','contact_person_phone','contact_person_name', 'pan','gst'
    ];
}
