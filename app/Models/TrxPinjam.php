<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPinjam extends Model
{
    use HasFactory;

    protected $table = 'trx_pinjam';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'date_pinjam',
        'date_retur',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        return ($value == 1) ? "Dikembalikan" : "Belum Dikembalikan";
    }

    public function user(){
        return $this->belongsTo(SysUser::class, 'user_id', 'id');
    }

    public function book(){
        return $this->belongsTo(MstBooks::class, 'book_id', 'id');
    }
}
