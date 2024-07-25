<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_surat', 'pengirim', 'tanggal_masuk', 'perihal'];

    public function disposisis()
    {
        return $this->hasMany(Disposisi::class);
    }
    public function dokuments()
    {
        return $this->hasMany(FileDokument::class, 'dokument_id');
    }

}
