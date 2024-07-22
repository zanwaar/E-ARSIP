<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function jabatans()
    {
        return $this->hasMany(Jabatan::class);
    }
    public function kepalaBidang()
    {
        return $this->hasOne(Jabatan::class)->where('name', 'Kepala');
    }

    public function kepalaSeksi()
    {
        return $this->hasOne(Jabatan::class)->where('name', 'Kepala Seksi');
    }

    public function staff()
    {
        return $this->hasMany(Jabatan::class)->where('name', 'Staff');
    }

    public function getTotalStaffAttribute()
    {
        return $this->staff->count();
    }
}
