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
    const KELUAR = 'SURAT KELUAR';
    const MASUK = 'SURAT MASUK';
    const DOKUMENT = 'DOKUMENT';

    public function getStatusBadgeAttribute()
    {
        $badges = [
            $this::KELUAR => 'danger',
            $this::MASUK => 'primary',
            $this::DOKUMENT => 'success',
        ];

        return $badges[$this->dokument];
    }
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }
}
