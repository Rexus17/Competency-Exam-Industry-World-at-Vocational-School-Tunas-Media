<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;
    protected $table = 'tbl_paket';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $filltable = [ 'id_paket', 'jenis', 'nama_paket', 'harga'];
    public $timestamps = false;
    public $incrementing = false;

    public function outlet (){
        return $this->hasOne(outlet::class, 'id', 'id_outlet');
    }
}
