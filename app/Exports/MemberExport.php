<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MemberExport implements FromView
{
    public function view() : View
    {
        //export adalah file export.blade.php yang ada di folder views
        return view('member/export', [
            //data adalah value yang akan kita gunakan pada blade nanti
            //User::all() mengambil seluruh data user dan disimpan pada variabel data
            'data' => Member::all()
        ]);
    }
}
