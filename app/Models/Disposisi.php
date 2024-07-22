<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $fillable = ['surat_masuk_id', 'user_id', 'bidang_id', 'isi_disposisi', 'is_read'];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }
}
