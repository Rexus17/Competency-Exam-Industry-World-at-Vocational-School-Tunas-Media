<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    public function outlet (){
        return $this->hasOne(outlet::class, 'id', 'id_outlet');
    }
}
