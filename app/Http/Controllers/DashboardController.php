<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\paket;
use App\Models\member;
use App\Models\outlet;
use App\Models\transaksi;
class DashboardController extends Controller
{
    public function indexAdmin(){
        $member = member::all() -> count();
        $paket = paket::all() -> count();
        $user = User::all() -> count();
        $outlet = outlet::all() -> count();

        return view('Admin.Dashboard',[
            'member' => $member,
            'outlet' => $outlet,
            'user' => $user,
            'paket' => $paket
        ]);
    }

    public function indexKasir(){
        if(Auth::check()){
            return redirect('/');
        }
    $member = member::all() -> count();
        return  view('Kasir.Dashboard',['member => $member']);
    }

    public function indexOwner(){
        $member = member::all() -> count();
        $paket = paket::all() -> count();
        $user = User::all() -> count();
        $outlet = outlet::all() -> count();

        return view('Owner.Dashboard',[
            'member' => $member,
            'outlet' => $outlet,
            'user' => $user,
            'paket' => $paket
        ]);
    }
}
