<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $guarded = ['id'];

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            $kategori->id = 'ktg' . str_pad(Kategori::count() + 1, 3, '0', STR_PAD_LEFT);
        });
    }

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id', 'id');
    }
}
