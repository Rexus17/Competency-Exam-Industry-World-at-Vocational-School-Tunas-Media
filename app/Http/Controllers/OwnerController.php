<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\outlet;
use App\Models\paket;
use App\Models\User;
class OwnerController extends Controller
{
    public function statistik(){
        $member = member::all() -> count();
        $outlet = outlet::all() -> count();
        $paket = paket::all() -> count();
        $user = User::all() -> count();

        return view('dashboard', [
            'member' => $member,
            'outlet' => $outlet,
            'paket' => $paket,
            'User' => $user,
        ]);
    }
}
