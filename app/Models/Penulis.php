<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Yajra\DataTables\Facades\DataTables;

class Penulis extends Model
{
    use HasFactory;

    protected $table = 'penulis';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'penulis_id', 'id');
    }
}
