<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'files';

    protected $fillable = [
        'uuid',
        'fileable_type',
        'fileable_id',
        'document_type',
        'file_path'
    ];



    public function fileable()
    {
        return $this->morphTo();
    }
}
