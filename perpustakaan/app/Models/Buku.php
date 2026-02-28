<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'kategori_id',
        'judul',
        'penulis',
        'penerbit',
        'isbn',
        'stok',
        'tahun_terbit',
    ];

   
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }
}
