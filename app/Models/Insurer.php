<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    use HasFactory;

    public function primaryEmails() {
        return $this->hasMany(PrimaryEmail::class);
    }
}