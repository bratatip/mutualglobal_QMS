<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCEmail extends Model
{
    use HasFactory;

    protected $table = 'c_c_emails';

    protected $fillable = [
        'uuid', 'email'
    ];

    public function primaryEmails()
    {
        return $this->belongsToMany(PrimaryEmail::class, 'primary_email_cc_email', 'cc_email_id', 'primary_email_id');
    }

}
