<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;
    protected $table = 'tbl_member';
    protected $primaryKey = 'id';
    protected $guarded = [ 'id'];
    protected $filltable = [ 'nama', 'alamat', 'jenis_kelamin', 'status', 'tlp'];
    public $timestamps = false;
    public $incrementing = false;
}
