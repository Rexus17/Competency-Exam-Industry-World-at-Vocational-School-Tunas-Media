<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // function log in
    public function index() {
        if(Auth::check()) {
            return redirect('/dashboard');
        }

        $dataoutlet = outlet::all();

        return view('login', ['dataoutlet' => $dataoutlet] );
    }

    // function log out
    public function logout() {
        Auth::logout();

        return redirect('/')->with('alert', ['bg' =>  'success', 'message' => 'Logout Success.']);
    }

    // function proses log in
    public function prosesLogin(Request $request) {
        // Validasi Jika Admin dan Kasir tidak memilih Outlet
        if(in_array($request->login_sebagai, ['admin', 'kasir']) && empty($request->id)) {
            return redirect('/')->with('alert', ['bg' => 'danger', 'message' => 'Fill Out the Outlet!']);
        } 

        // cek username dan role pengguna
        $data_user = User::where('username', $request->username)->where('role', $request->login_sebagai)
            ->when(!empty($request->id), function($query) use($request) {
                $query->where('id_outlet', $request->id);
            })->first();

        // cek password pengguna
        if($data_user === NULL || !Hash::check($request->password, $data_user->password) )
        {
            return redirect('/')->with('alert', ['bg' => 'danger', 'message' => 'Username or Password nothing in Database!']);
        }

        // arahkan pengguna ke dashboard
        Auth::login($data_user);
        return redirect('/Dashboard')->with('alert', ['bg' => 'success', 'message' => 'Login Success']);
    }
}
