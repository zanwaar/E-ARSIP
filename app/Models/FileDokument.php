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
            self::KELUAR => 'danger',
            self::MASUK => 'primary',
            self::DOKUMENT => 'success',
        ];

        return $badges[$this->dokument];
    }
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
    // public function suratmasuk()
    // {

    //     return $this->belongsTo(SuratMasuk::class, 'dokument_id', 'id')
    //         ->where('dokument', self::MASUK);
    // }
    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'surat_masuk_id', 'dokument_id');
    }
}
