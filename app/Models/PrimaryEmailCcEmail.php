<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryEmailCcEmail extends Model
{
    use HasFactory;
    

    protected $table = 'primary_email_cc_email';

    protected $fillable = [
        'uuid', 'primary_email_id','cc_email_id',
    ];
}
