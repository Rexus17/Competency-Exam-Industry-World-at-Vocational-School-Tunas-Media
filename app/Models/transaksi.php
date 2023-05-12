<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = true;

    public function outlet() {
        return $this->hasOne(outlet::class, 'id', 'id_outlet');
    }

    public function member() {
        return $this->hasOne(member::class, 'id', 'id_member');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function paket() {
        return $this->hasOne(paket::class, 'id', 'id_paket');
    }
    public function detail() {
        return detail::select('tbl_detail_transaksi.*', 'tbl_paket.harga') -> join('paket','paket.id', '=', 'tbl_detail_transaksi.id_paket' ) 
        -> where('id_transaksi',$this ->id_transaksi) -> get();
    }
}
