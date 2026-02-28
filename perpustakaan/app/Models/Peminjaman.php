<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_realisasi',
        'denda',
        'status',
    ];

   
    protected $casts = [
        'tanggal_pinjam'    => 'date',
        'tanggal_kembali'   => 'date',
        'tanggal_realisasi' => 'date',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }
}
