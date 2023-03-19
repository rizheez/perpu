<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Model;

class Petugas extends Model
{
    use HasFactory;
    // use \Illuminate\Auth\Authenticatable;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($petugas) {
            // Ambil ID terakhir dari petugas yang masih tersimpan di database
            $lastPetugas = Petugas::orderBy('id', 'desc')->first();
            $lastId = $lastPetugas ? intval(substr($lastPetugas->id, 3)) : 0;

            // Tambahkan 1 ke ID terakhir untuk membuat ID yang baru
            $newId = $lastId + 1;

            // Set ID petugas baru dengan format ptg001 dst
            $petugas->id = 'ptg' . str_pad($newId, 3, '0', STR_PAD_LEFT);
        });
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function isAdmin()
    {
        return $this->is_admin === 1;
    }

    public function hasRole($roleName)
    {
        return $this->role == $roleName; // sample implementation only
    }
}
