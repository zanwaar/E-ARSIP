<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_surat', 'penerima', 'tanggal_keluar', 'perihal', 'bidang_id'];
    public function dokuments()
    {
        return $this->hasMany(FileDokument::class, 'dokument_id');
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}
