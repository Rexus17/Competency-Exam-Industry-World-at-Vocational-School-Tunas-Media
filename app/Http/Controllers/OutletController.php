<?php

namespace App\Http\Controllers;

use App\Exports\OutletExport;
use App\Models\User;
use App\Models\paket;
use App\Models\outlet;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class OutletController extends Controller
{
    // tampilkan data outlet
    public function index(Request $request) {
        // $projects = Project::where([
        //     ['nama', '!=', null],
        //     [function ($query) use ($request) {
        //         if (($term = $request->term)) {
        //             $query->orWhere('nama', 'LIKE', '%' . $term . '%')->get();
        //         }
        //     }]
        // ])
        //     ->orderBy("id", "desc")
        //     ->paginate(10);

        $DataOutlet = outlet::when(!empty($request->search_outlet), function($query) use ($request) {
            $query->where('id', 'like', '%' . $request->search_outlet . '%' )
            ->orWhere('nama', 'like', '%' . $request->search_outlet . '%')
            ->orWhere('alamat', 'like', '%' . $request->search_outlet . '%')
            ->orWhere('tlp', 'like', '%' . $request->search_outlet . '%');
        })->paginate(10);

        return view('outlet/data_outlet', ['tbl_outlet' => $DataOutlet]);
        // return view('DataOutlet.index', compact('DataOutlet'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        // $outlet = Outlet::all();
        // return view('outlet/data_outlet', ['tbl_outlet' => $DataOutlet]);
    }

    // export data outlet
    public function export()
    {
        return Excel::download(new OutletExport, 'Data_Outlet.xlsx');
        // $Outlet = Outlet::all();
        // return view('outlet/outlet_laporan', ['data_outlet' => $Outlet]);

        // $pdf = PDF::loadview('outlet-pdf', ['data_outlet' => $Outlet]);
        // return $Outlet->download('laporan-pegawai-pdf');
    }

    // tambah data outlet
    public function tambahOutlet(Request $request)
    {
        $newOutlet = new outlet();
        $newOutlet->nama = $request->nama;
        $newOutlet->alamat = $request->alamat;
        $newOutlet->tlp = $request->tlp;

        $newOutlet->save();
        return redirect('/outlet/data_outlet')->with('alert', ['bg' => 'success', 'message' => 'success add outlet']);
    }

    // edit outlet
    public function editOutlet(outlet $data_outlet, Request $request){

        $data_outlet->nama = $request->nama;
        $data_outlet->alamat = $request->alamat;
        $data_outlet->tlp = $request->tlp;

        $data_outlet->save();
        return redirect('/outlet/data_outlet')->with('alert', ['bg' => 'success', 'message' => 'outlet success to edit']);
     }

    // delete outlet
    public function deleteOutlet(outlet $data_outlet){

        $user = User::where('id_outlet',$data_outlet->id)->first();
        $paket = paket::where('id_outlet',$data_outlet->id)->first();

        if ($user != null && $paket != null) {
            return redirect()->back()->with('alert', ['bg' => 'danger', 'message' => 'outlet cant to delete, cause outlet is use']);
        }else{
            $data_outlet->delete();
            return redirect('/outlet/data_outlet')->with('alert', ['bg' => 'success', 'message' => 'outlet success to delete']);
        }
     }

}
