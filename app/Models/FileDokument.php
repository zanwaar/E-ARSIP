<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDokument extends Model
{
    use HasFactory;
    protected $fillable = [
        'dokument_id',
        'dokument',
        'file',
        'size',
    ];
}
