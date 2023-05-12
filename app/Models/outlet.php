<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    use HasFactory;
    protected $table = 'tbl_outlet';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $filltable = [ 'nama', 'alamat', 'tlp'];
    public $timestamps = false;
    public $incrementing = false;
}
