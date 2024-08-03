<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Voucher;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $data = Voucher::all();

        return view('dashboard.voucher.voucher-index',compact('data'));
    }

    public function store(Request $request)
    {
        $biayaPhotobooth = Biaya::first();
        $expired = $request->kadaluarsa ?? null;

        $biayaPhotobooth->createVouchers($request->qty,[],$expired);


        return redirect()->back();
    }
}
