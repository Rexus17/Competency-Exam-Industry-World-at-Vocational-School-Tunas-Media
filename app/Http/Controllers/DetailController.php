<?php

namespace App\Http\Controllers;

use App\Models\paket;
use App\Models\transaksi;
use Illuminate\Http\Request;
use App\Models\detail;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function indexDetail(transaksi $transaksi) {
        $transaksi->detail;
        return view('transaksi/detail_transaksi', ['transaksi' => $transaksi]);
    }
}
