<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MstBooks extends Model
{
    use HasFactory;

    protected $table = 'mst_books';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'penerbit',
        'user_id',
        'halaman',
        'stok',
    ];

    public function pinjam(){
        return $this->hasMany(TrxPinjam::class, 'book_id');
    }

}
