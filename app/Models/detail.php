<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_transaksi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = true;

    public function transaksi() {
        return $this->hasOne(Transaksi::class, 'id', 'id_transaksi');
    }
    public function paket() {
        return $this->hasOne(Paket::class, 'id', 'id_paket');
    }
}
