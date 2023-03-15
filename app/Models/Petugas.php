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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($petugas) {
            $petugas->id = 'ptg' . str_pad(Petugas::count() + 1, 3, '0', STR_PAD_LEFT);
        });
    }
}
