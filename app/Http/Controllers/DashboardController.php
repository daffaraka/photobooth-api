<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function biayaPhotobooth()
    {
        $data['biaya'] = Biaya::first();
        return view('dashboard.biaya.biaya-index',$data);
    }

    public function updateBiayaPhotobooth(Request $request)
    {
        $biaya = Biaya::updateOrCreate(['id' => $request->id], ['biaya' => $request->biaya]);
        $biaya->save();
        return redirect()->route('dashboard.biaya-photobooth');
    }
}
