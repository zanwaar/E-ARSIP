<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $guarded = [];
    const KADIS = 'KADIS';
    const KABIB = 'SUBKABIB';
    const KASIH = 'KASI';
    const STAFF = 'STAFF';

    public function getStatusBadgeAttribute()
    {
        $badges = [
            $this::KADIS => 'dark',
            $this::KABIB => 'primary',
            $this::KASIH => 'warning',
            $this::STAFF => 'success',
        ];

        return $badges[$this->alias] ?? $badges[self::STAFF];
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
