<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($anggota) {
            // Ambil ID terakhir dari anggota yang masih tersimpan di database
            $lastAnggota = Anggota::orderBy('id', 'desc')->first();
            $lastId = $lastAnggota ? intval(substr($lastAnggota->id, 4)) : 0;

            // Tambahkan 1 ke ID terakhir untuk membuat ID yang baru
            $newId = $lastId + 1;

            // Set ID anggota baru dengan format APTI00001 dst
            $anggota->id = 'APTI' . str_pad($newId, 5, '0', STR_PAD_LEFT);
        });
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
