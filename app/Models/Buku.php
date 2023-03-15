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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($buku) {
            $buku->id = 'bku' . str_pad(Buku::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'penulis_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
