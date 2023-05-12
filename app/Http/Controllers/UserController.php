<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    // tampilankan data pengguna
    public function index(Request $request) 
    {
        $DataUser = User::when(!empty($request->search_user), function($query) use ($request) {
            $query->where('id', 'like', '%' . $request->search_user . '%' )
            ->orWhere('nama', 'like', '%' . $request->search_user . '%')
            ->orWhere('username', 'like', '%' . $request->search_user . '%')
            ->orWhere('id_outlet', 'like', '%' . $request->search_user . '%');
            
        })->paginate(10);

        $datao = outlet::all();
        return view('user/data_user', ['tbl_user' => $DataUser, 'datao' => $datao]);
    }

    // public function export()
    // {
    //     return Excel::download(new UserController, 'Data_User.xlsx');
    // }

    // tambah pengguna
    public function tambahUser(Request $request)
    {
        $newUser = new User();
        $newUser->nama = $request->nama;
        $newUser->username = $request->username;
        $newUser->password = Hash::make($request->password);
        $newUser->id_outlet = $request->id_outlet;
        $newUser->role = $request->role;
        $newUser->save();
        return redirect('/user/data_user')->with('alert', ['bg' => 'success', 'message' => 'user success to add']);
    }

    // edit pengguna
    public function editUser(user $data_user, Request $request){

        $data_user->nama = $request->nama;
        $data_user->username = $request->username;
        $data_user->password = !empty($request->password) ?Hash::make($request->password) : $data_user->password;
        $data_user->id_outlet = $request->id_outlet;
        $data_user->role = $request->role;

        $data_user->save();
        return redirect('/user/data_user')->with('alert', ['bg' => 'success', 'message' => 'user success to edit']);
    }

    // delete pengguna
    public function deleteUser(user $data_user){
        $data_user->delete();
        return redirect('/user/data_user')->with('alert', ['bg' => 'success', 'message' => 'user success to delete']);
    }
}
