<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($buku) {
            // Ambil ID terakhir dari buku yang masih tersimpan di database
            $lastBuku = Buku::orderBy('id', 'desc')->first();
            $lastId = $lastBuku ? intval(substr($lastBuku->id, 3)) : 0;

            // Tambahkan 1 ke ID terakhir untuk membuat ID yang baru
            $newId = $lastId + 1;

            // Set ID buku baru dengan format ptg001 dst
            $buku->id = 'bku' . str_pad($newId, 3, '0', STR_PAD_LEFT);
        });

        // static::creating(function ($buku) {
        //     $buku->id = 'bku' . str_pad(Buku::count() + 1, 4, '0', STR_PAD_LEFT);
        // });
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'penulis_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
