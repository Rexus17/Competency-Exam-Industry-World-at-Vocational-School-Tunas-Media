<?php

namespace App\Http\Controllers;

use App\Models\paket;
use App\Models\outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PaketController extends Controller
{
    public function index(Request $request) {
        $DataPaket = paket::with('outlet')->when(!empty($request->search_paket), function($query) use ($request) {
            $query->where('id', 'like', '%' . $request->search_paket . '%' )
            ->orWhere('id_outlet', 'like', '%' . $request->search_paket . '%')
            ->orWhere('jenis', 'like', '%' . $request->search_paket . '%')
            ->orWhere('nama_paket', 'like', '%' . $request->search_paket . '%')
            ->orWhere('harga', 'like', '%' . $request->search_paket . '%');
        }) -> paginate(10);

        $datao = outlet::all();
        return view('paket/paket_laundry', ['tbl_paket' => $DataPaket, 'datao' => $datao]);
    }

    public function export()
    {
        return Excel::download(new PaketController, 'Data_Paket.xlsx');
    }

    public function tambahPaket(Request $request)
    {
        $newPaket = new paket();
        $newPaket->id_outlet = $request->id_outlet;
        $newPaket->jenis = $request->jenis;
        $newPaket->nama_paket = $request->nama_paket;
        $newPaket->harga = $request->harga;

        $newPaket->save();
        return redirect('/paket/paket_laundry')->with('alert', ['bg' => 'success', 'message' => 'Success to Order the Package.']);
    }

        public function editPaket(paket $data_paket, Request $request){

            $data_paket->id_outlet = $request->id_outlet;
            $data_paket->jenis = $request->jenis;
            $data_paket->nama_paket = $request->nama_paket;
            $data_paket->harga = $request->harga;

            $data_paket->save();
            return redirect('/paket/paket_laundry')->with('alert', ['bg' => 'success', 'message' => 'order package success to edit.']);
         }
            public function deletePaket(paket $data_paket){
               
                $data_paket->delete();
                return redirect('/paket/paket_laundry')->with('alert', ['bg' => 'success', 'message' => 'order package success to delete.']);
         }
}
