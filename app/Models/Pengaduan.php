<?php

namespace App\Models;

use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tanggap(): HasOne
    {
        return $this->HasOne(Tanggapan::class, 'pengaduan_id');
    }

    public function tanggapan(): HasMany
    {
        return $this->hasMany(Tanggapan::class);
    }
}
