<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function getNamaBukuAttribute()
    {
        return $this->buku->judul;
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
}
